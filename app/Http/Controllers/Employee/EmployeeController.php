<?php
namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('employee.dashboard');
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





    public function notifications()
{
    $notifications = Auth::emplyee()->unreadNotifications;

    return view('user.notifications.index', compact('notifications'));
    //// 


    
}
    public function notificationsfares()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $readNotifications = auth()->user()->readNotifications;

        // Marquer les notifications non lues comme lues
        $unreadNotifications->markAsRead();

        return view('user.dashboard', compact('unreadNotifications', 'readNotifications'));
    }




    public function markAllAsRead()
    {
        // Mark all unread notifications as read
        auth()->user()->unreadNotifications->markAsRead();

        // Redirect to the notifications page
        return redirect()->route('employee.notifications');
    }

}