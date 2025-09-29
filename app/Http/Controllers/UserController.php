<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Lijst van gebruikers (read-only voor alle ingelogde users).
     *
     * - Optionele zoekvraag via ?q=... (op naam of e-mail)
     * - Paginatie (12 per pagina) met querystring behouden
     *
     * Route: GET /users  (naam: users.index)
     * View : resources/views/users/index.blade.php
     */
    public function index(Request $request)
    {
        $q = (string) $request->query('q', '');

        $users = User::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($q2) use ($q) {
                    $q2->where('name', 'like', "%{$q}%")
                       ->orWhere('email', 'like', "%{$q}%");
                });
            })
            ->withCount('noShowReportsReceived') // ⬅️ laad teller mee om in lijst te tonen
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        return view('users.index', compact('users', 'q'));
    }

    /**
     * Profiel van 1 gebruiker tonen (read-only).
     *
     * - Iedereen die is ingelogd mag kijken (Policy->view checkt dit)
     * - Laadt aantal No Show meldingen + de laatste 10 meldingen met reporter
     *
     * Route: GET /users/{user}  (naam: users.show)
     * View : resources/views/users/show.blade.php
     */
    public function show(User $user)
    {
        // Policy: iedereen die is ingelogd mag andere profielen bekijken
        $this->authorize('view', $user);

        // Laad No Show data erbij (count + laatste 10 meldingen incl. reporter)
        $user->loadCount('noShowReportsReceived')
             ->load(['noShowReportsReceived' => fn($q) =>
                 $q->with('reporter')->latest()->limit(10)
             ]);

        return view('users.show', compact('user'));
    }

    /**
     * Formulier om een profiel te bewerken.
     *
     * - Alleen eigenaar of admin (Policy->update)
     *
     * Route: GET /users/{user}/edit  (naam: users.edit)
     * View : resources/views/users/edit.blade.php
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Profiel opslaan.
     *
     * - Alleen eigenaar of admin (Policy->update)
     * - Validatie met unieke e-mail (uitgezonderd huidige gebruiker)
     *
     * Route: PUT /users/{user}  (naam: users.update)
     * Redirect: terug naar users.show + flash status
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            // Voeg hier extra velden toe zodra je ze wilt bewerken, bijv.:
            // 'full_name' => ['nullable', 'string', 'max:255'],
            // 'bio'       => ['nullable', 'string', 'max:1000'],
        ]);

        $user->update($data);

        return redirect()
            ->route('users.show', $user)
            ->with('status', 'Profiel bijgewerkt.');
    }
}
