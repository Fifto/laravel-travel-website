namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AgencyProfile;

class AdminController extends Controller
{
    // Display the admin page
    public function index()
    {
        // Retrieve the agency profile data (assuming there's only one)
        $profile = AgencyProfile::first();

        return view('admin-homepage', compact('profile'));
    }

    // Handle the update request
    public function update(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'agency_name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'contact_email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        // Assuming there's only one agency profile record
        $profile = AgencyProfile::first();

        // Update the agency profile data
        $profile->update($validatedData);

        return redirect()->route('admin.index')->with('success', 'Agency profile updated successfully.');
    }
}
