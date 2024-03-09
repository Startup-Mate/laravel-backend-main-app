<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchmakingController extends Controller
{
    public function findMatches(Request $request)
    {
        $user = $request->user();

        $criteria = $request->only(['skill', 'country', 'district', 'interested_in', 'type']);
        if (empty(array_filter($criteria))) {
            // If no criteria, show a random user
            $randomMatch = DB::table('users')
                ->where('id', '!=', $user->id)
                ->inRandomOrder()
                ->first();
            unset($randomMatch->email, $randomMatch->password);
            dump(json_encode($randomMatch));
            return response()->json(['match' => $randomMatch]);
        }

        $query = DB::table('users');

        foreach ($criteria as $key => $value) {
            if (!empty($value)) {
                if ($key === 'skill') {
                    $query->whereJsonContains('skill', [$value => true]);
                } elseif ($key === 'type') {
                    $query->where($key, $value);
                } else {
                    $query->where($key, $value);
                }
            }
        }

        if ($user) {
            $query->where('id', '!=', $user->id);
        }

        if ($user) {
            $shownUsers = $user->matches()->pluck('matched_user_id')->toArray();
            $query->whereNotIn('id', $shownUsers);
        }

        $match = $query->first();

        // If no match found, check if someone from the user's previously matched people matches the criteria
        if (!$match) {
            $previousMatches = $user->matches()->pluck('matched_user_id')->toArray();

            $queryPreviousMatches = DB::table('users');
            foreach ($criteria as $key => $value) {
                if (!empty($value)) {
                    if ($key === 'skill') {
                        $queryPreviousMatches->whereJsonContains('skill', [$value => true]);
                    } elseif ($key === 'type') {
                        $queryPreviousMatches->where($key, $value);
                    } else {
                        $queryPreviousMatches->where($key, $value);
                    }
                }
            }

            $queryPreviousMatches->whereIn('id', $previousMatches);
            $match = $queryPreviousMatches->first();
        }

        // If still no match found, show a random user
        if (!$match) {
            $randomMatch = DB::table('users')
                ->where('id', '!=', $user->id)
                ->inRandomOrder()
                ->first();
            unset($randomMatch->email, $randomMatch->password);
            return response()->json(['match' => $randomMatch]);
        }

        // Record the match in the 'matches' table
        $user->matches()->create([
            'matched_user_id' => $match->id,
        ]);

        if ($match) {
            unset($match->email, $match->password);
        }

        return response()->json(['match' => $match]);
    }
}
