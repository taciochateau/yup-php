namespace App\Http\Controllers;

use App\Models\NotificationType;
use Illuminate\Http\Request;

class NotificationTypeController extends Controller
{
    public function create(Request $request)
    {
        $type = NotificationType::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
        ]);

        return response()->json($type);
    }

    public function update(Request $request, $id)
    {
        $type = NotificationType::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $type->update($request->all());

        return response()->json($type);
    }

    public function delete($id)
    {
        $type = NotificationType::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        if ($type->notifications()->count() > 0) {
            return response()->json(['error' => 'Type is in use'], 400);
        }

        $type->delete();

        return response()->json(['message' => 'Type deleted']);
    }

    public function myTypes()
    {
        $types = NotificationType::where('user_id', auth()->id())->get();

        return response()->json($types);
    }
}