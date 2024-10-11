namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function create(Request $request)
    {
        $notification = Notification::create([
            'user_id' => auth()->id(),
            'type_id' => $request->type_id,
            'title' => $request->title,
            'description' => $request->description,
            'body' => $request->body,
            'image' => $request->image,
        ]);

        return response()->json($notification);
    }

    public function update(Request $request, $id)
    {
        $notification = Notification::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $notification->update($request->all());

        return response()->json($notification);
    }

    public function delete($id)
    {
        Notification::where('id', $id)->where('user_id', auth()->id())->delete();

        return response()->json(['message' => 'Notification deleted']);
    }

    public function myNotifications()
    {
        $notifications = Notification::where('user_id', auth()->id())->get();

        return response()->json($notifications);
    }

    public function notificationsByType($type_id)
    {
        $notifications = Notification::where('user_id', auth()->id())->where('type_id', $type_id)->get();

        return response()->json($notifications);
    }
}