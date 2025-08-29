<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Prewk\XmlStringStreamer;
use Prewk\XmlStringStreamer\Stream\File;
use Prewk\XmlStringStreamer\Parser\StringWalker;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('welcome', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'number' => 'required|digits:10',
            ]
        );
        User::create([
            'name'   => $request->name,
            'mobile_number' => $request->number,
        ]);
        return redirect()->route('users.index')->with('success', 'User added successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::find($id);
        if($users){
            return view('welcome_edit', compact('users'));
        }
        else{
            return  abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'number' => 'required|digits:10',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name'          => $request->name,
            'mobile_number' => $request->number,
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }

    public function importXml(Request $request)
    {
        // File validate: required + max size
        $request->validate([
            'file' => 'required|file|max:5120', // 5MB
        ]);


        $file = $request->file('file');

        // Original extension check
        if ($file->getClientOriginalExtension() !== 'xml') {
            return back()->withErrors(['file' => 'Only XML files are allowed.']);
        }

        // MIME type check (optional)
        $mime = $file->getMimeType();

       // dd($mime);
        if (!in_array($mime, ['text/xml', 'application/xml','text/plain'])) {
            return back()->withErrors(['file' => 'Invalid MIME type']);
        }

        $path = $request->file('file')->store('imports', 'public');
        // ✅ Streamer setup
        $stream = new File(storage_path("app/public/{$path}"), 1024);
        $parser = new StringWalker();
        $streamer = new XmlStringStreamer($parser, $stream);

        $batch = [];
        $batchSize = 500;


        while ($node = $streamer->getNode()) {
            $xml = simplexml_load_string($node);
            $array = json_decode(json_encode($xml), true);

            $batch[] = [
                'name'  => $array['name'] ?? null,
                'mobile_number' => $array['phone'] ?? null,
            ];
            if (count($batch) >= $batchSize) {
                User::insert($batch);
                $batch = [];
            }
        }
        if (!empty($batch)) {
            User::insert($batch);
        }
        return back()->with('success', 'Large XML imported successfully!');

    }


    public function importXml_fdssdf(Request $request)
    {
        echo"<pre>"; print_r($request->all()); echo"</pre>";
        try {

            $request->validate([
                'file' => 'required|file|mimes:xml,text/xml|max:5120',
                ]);

            dd('dsada'); // Ye tabhi chalega jab validation pass karega
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd(['catch',$e->errors()]); // Ye dikha dega konsi validation fail ho rahi hai
        }


        dd('dfasfd');
        // ✅ Validate
        $request->validate([
            'file' => 'required|file|mimetypes:text/xml,application/xml|max:5120', // 5MB
        ]);

        dd('dsada');
        if ($request->file('file')->getClientOriginalExtension() !== 'xml') {
            return back()->withErrors(['file' => 'Only XML files are allowed.']);
        }

        // ✅ Save file to storage/app/public/imports
        $path = $request->file('file')->store('imports', 'public');

        // ✅ Streamer setup
        $stream = new File(storage_path("app/public/{$path}"), 1024);
        $parser = new StringWalker();
        $streamer = new XmlStringStreamer($parser, $stream);

        $batch = [];
        $batchSize = 500;

        // ✅ Loop nodes
        while ($node = $streamer->getNode()) {
            $xml = simplexml_load_string($node);
            $array = json_decode(json_encode($xml), true);

            $batch[] = [
                'name'  => $array['name'] ?? null,
                'email' => $array['email'] ?? null,
            ];

            if (count($batch) >= $batchSize) {
                User::insert($batch);
                $batch = [];
            }
        }

        if (!empty($batch)) {
            User::insert($batch);
        }

        return back()->with('success', 'Large XML imported successfully!');
    }

    public function importXml_oo(Request $request)
    {

        echo "<pre>"; print_r($request->all()); echo "</pre>";


        // File validate: required + max size
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:5120',
        ]);
        if ($validator->fails()) {
            dd($validator->errors()->all());
        }

        // Original extension check
        if ($request->file('file')->getClientOriginalExtension() !== 'xml') {
            return back()->withErrors(['file' => 'Only XML files are allowed.']);
        }

        // MIME type check (optional)
        $mime = $request->file('file')->getMimeType();
        if (!in_array($mime, ['text/xml', 'application/xml'])) {
            return back()->withErrors(['file' => 'Invalid MIME type for XML.']);
        }

        dd('File validation passed!'); // Ab ye print hoga
    }

}
