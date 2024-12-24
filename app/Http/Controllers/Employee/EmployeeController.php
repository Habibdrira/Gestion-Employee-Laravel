<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Employee;
use App\Models\Absence;

use App\Models\Performance;

use App\Models\Prime;
class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // Vérifier si l'utilisateur est authentifié
    if (auth()->check()) {
        // Récupérer l'employé lié à l'utilisateur connecté
        $employee = auth()->user()->employee;

        // Vérifier si l'employé existe
        if ($employee) {
            // Récupérer les primes, performances, et absences pour cet employé
            $primes = Prime::where('employee_id', $employee->employee_id)->sum('amount');
            $performances = Performance::where('employee_id', $employee->employee_id)->count();
            $absences = Absence::where('employee_id', $employee->employee_id)->count();

            $notifications = auth()->user()->unreadNotifications;


return view('employee.dashboard', compact('notifications', 'primes', 'performances', 'absences'));

                } else {
            // Si aucun employé n'est trouvé pour cet utilisateur
            return redirect()->route('home')->with('error', 'Employé non trouvé.');
        }
    } else {
        // Si l'utilisateur n'est pas authentifié
        return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
    }
    }

    public function indexAdmin()
    {
        $employees = Employee::with('user')->get();
        return view('admin.gereEmpl.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.gereEmpl.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'lastname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        try {
            // Créer l'utilisateur
            $user = User::create([
                'email' => $validated['email'],
                'password' => $validated['password'], // Utilise le mutateur dans le modèle
                'lastname' => $validated['lastname'],
                'name' => $validated['name'],
                'role_id' => 2, // Vérifiez que 2 correspond au rôle "Employé"
            ]);

            // Créer l'employé associé
            Employee::create([
                'user_id' => $user->id,
                'address' => $validated['address'],
                'city' => $validated['city'],
                'position' => $validated['position'],
                'salary' => $validated['salary'],
            ]);

            // Redirection avec message de succès
            return redirect()->route('admin.gereEmpl.index')->with('success', 'Employé ajouté avec succès');

        } catch (\Exception $e) {
            // Enregistrer l'erreur dans les logs
            Log::error('Erreur lors de l\'insertion d\'un employé : ' . $e->getMessage());

            // Redirection avec message d'erreur
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout de l\'employé.');
        }
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.gereEmpl.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $user = $employee->user;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
        ]);

        try {
            $user->update([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
            ]);

            $employee->update([
                'city' => $validated['city'],
                'position' => $validated['position'],
                'salary' => $validated['salary'],
            ]);

            return redirect()->route('admin.gereEmpl.index')->with('success', 'Employé mis à jour avec succès');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de l\'employé : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour.');
        }
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $user = $employee->user;

        try {
            $employee->delete();
            $user->delete();

            return redirect()->route('admin.gereEmpl.index')->with('success', 'Employé supprimé avec succès');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de l\'employé : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression.');
        }
    }


    
    


    public function prime()
    {
        // Vérifier si l'utilisateur est authentifié
        if (auth()->check()) {
            // Récupérer l'employé lié à l'utilisateur connecté
            $employee = auth()->user()->employee;
    
            // Vérifier si l'employé existe
            if ($employee) {
                // Récupérer uniquement le montant et la date des primes
                $primes = Prime::where('employee_id', $employee->employee_id)
                    ->orderBy('date_awarded', 'desc')
                    ->get(['amount', 'date_awarded']); // Récupération des colonnes spécifiques
    
                // Retourner la vue avec les données des primes
                return view('employee.primes.index', compact('primes'));
            }
    
            // Rediriger si aucun employé n'est trouvé
            return redirect()->route('employee.dashboard')->with('error', 'Aucun employé trouvé.');
        }
    
        // Rediriger si l'utilisateur n'est pas authentifié
        return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
    }
    

    public function performance()
    {
        // Vérifier si l'utilisateur est authentifié
        if (auth()->check()) {
            // Récupérer l'employé lié à l'utilisateur connecté
            $employee = auth()->user()->employee;
    
            // Vérifier si l'employé existe
            if ($employee) {
                // Récupérer uniquement la note et la date des performances
                $performances = Performance::where('employee_id', $employee->employee_id)
                    ->orderBy('date', 'desc')
                    ->get(['rating', 'date']); // Récupération des colonnes spécifiques
    
                // Retourner la vue avec les données des performances
                return view('employee.performances.index', compact('performances'));
            }
    
            // Rediriger si aucun employé n'est trouvé
            return redirect()->route('employee.dashboard')->with('error', 'Aucun employé trouvé.');
        }
    
        // Rediriger si l'utilisateur n'est pas authentifié
        return redirect()->route('login')->with('error', 'Veuillez vous connecter.');
    }
    



}