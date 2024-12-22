<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class LoanController extends Controller
{
    // Afficher la liste des prêts de l'utilisateur connecté
    public function index()
    {
        $user = Auth::user();

        // Vérifier si l'utilisateur est connecté
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'Vous devez être connecté pour accéder à vos prêts.']);
        }

        // Récupérer les prêts de l'utilisateur connecté
        $loans = Loan::where('user_id', $user->id)->get();

        return view('user.loans.index', compact('loans'));
    }

    // Formulaire pour soumettre une nouvelle demande
    public function create()
    {
        return view('user.loans.create');
    }

    // Soumettre une nouvelle demande de prêt
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'reason' => 'nullable|string|max:255',
        ]);

        Loan::create([
            'user_id' => Auth::id(),
            'amount' => $request->amount,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->route('loans.index')->with('success', 'Votre demande de prêt a été soumise.');
    }

    // Liste des prêts pour l'admin
    public function adminIndex()
    {
        // Récupérer uniquement les prêts en attente
        $loans = Loan::where('status', 'pending')->get();

        return view('admin.loans.index', compact('loans'));
    }

    // Approuver un prêt
    public function approve(Loan $loan)
    {
        $loan->update([
            'status' => 'approved',
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('admin.loans.index')->with('success', 'Le prêt a été approuvé.');
    }

    // Refuser un prêt
    public function reject(Loan $loan)
    {
        $loan->update([
            'status' => 'rejected',
            'admin_id' => Auth::id(),
        ]);

        return redirect()->route('admin.loans.index')->with('success', 'Le prêt a été rejeté.');
    }
   // LoanController.php

public function loanHistory()
{
    // Récupérer l'historique des prêts (status : approved ou rejected)
    $loans = Loan::whereIn('status', ['approved', 'rejected'])->get();

    // Retourner la vue avec les prêts
    return view('admin.loans.history', compact('loans'));
}

public function downloadCSV()
{
    // Récupérer l'historique des prêts (status : approved ou rejected)
    $loans = Loan::whereIn('status', ['approved', 'rejected'])->get();

    // Créer le contenu du CSV
    $csvContent = "ID,Utilisateur,Montant,Raison,Statut,Date de demande\n";

    foreach ($loans as $loan) {
        $csvContent .= "{$loan->id},{$loan->user->name},{$loan->amount},{$loan->reason},{$loan->status},{$loan->created_at->format('d/m/Y')}\n";
    }

    // Créer une réponse de téléchargement
    return response()->make($csvContent, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="historique_prets.csv"',
    ]);
}


}
