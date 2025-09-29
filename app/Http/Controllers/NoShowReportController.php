<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\NoShowReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class NoShowReportController extends Controller
{
    /**
     * Maak/registreer een No Show melding voor een gebruiker.
     * - Alleen ingelogd (auth middleware regelt dat)
     * - Niet jezelf rapporteren
     * - Max 1 melding per (reporter, reported) dankzij unieke index
     */
    public function store(Request $request, User $user)
    {
        $reporter = $request->user();

        // Niet jezelf
        if ($reporter->id === $user->id) {
            return back()->with('status', 'Je kunt jezelf niet rapporteren.');
        }

        $data = $request->validate([
            'reason' => ['nullable', 'string', 'max:1000'],
        ]);

        try {
            NoShowReport::create([
                'reported_user_id' => $user->id,
                'reporter_user_id' => $reporter->id,
                'reason'           => $data['reason'] ?? null,
            ]);
            return back()->with('status', 'No Show geregistreerd.');
        } catch (QueryException $e) {
            // Duplicate (unique constraint) -> al eens gerapporteerd
            return back()->with('status', 'Je hebt deze student al gerapporteerd.');
        }
    }
    /**
     * A) Verwijder één no-show melding (admin only via middleware).
     */
    public function destroy(Request $request, NoShowReport $report)
    {
        $reportedUser = $report->reportedUser; // voor redirect
        $report->delete();

        return back()->with('status', 'No Show melding verwijderd.');
    }

    /**
     * B) Verwijder alle no-shows van een specifieke gebruiker (admin only).
     */
    public function destroyAllForUser(Request $request, User $user)
    {
        $count = $user->noShowReportsReceived()->count();
        $user->noShowReportsReceived()->delete();

        return back()->with('status', $count.' No Show melding(en) verwijderd.');
    }
}

