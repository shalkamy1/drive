<?php

namespace App\Http\Controllers;
 use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Drive;
use Illuminate\Http\Request;

class DriveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id=auth()->id();
        $drives=Drive::where("user_id",$user_id)->paginate(20);
        $categoreis=Category::paginate(20);
        return view('drives.index',compact('drives','categoreis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $drives=Drive::paginate(20);
        $categoreis=Category::paginate(20);
        return view('drives.create',compact('categoreis','drives'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>"required |max:30 | min:3|string|unique:categoreis,title,",
            'description'=>'required |max:50 | min:3|string',
         ]);
            $drive=new Drive();
            $drive->title=$request->title;
            $drive->description=$request->description;
            $drive_Data = $request->file("file");
            $file_ext = $drive_Data->getClientOriginalExtension();
                    $file_Name = $drive_Data->getClientOriginalName();
                    $location = public_path() . '/upload';
                    $drive_Data->move($location, $file_Name);
                    $drive->file = $file_Name;
                    $drive->file_ext = $file_ext;
                    $drive->user_id=auth()->user()->id;
            $drive->Category_id=$request->Category_id;
            $drive->save();
            return redirect()->back()->with("done","create succefuly");
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $drivecategory=DB::TABLE('drivecategory')->where('id',$id)->first();
return view('drives.show',compact('drivecategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $drives=DB::TABLE('drivecategory')->where('id',$id)->first();
        $categoreis=Category::paginate(20);
        return view('drives.edit',compact('drives','categoreis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $drive = Drive::find($id);
        $drive->title = $request->title;
        $drive->description = $request->description;
        $drive->Category_id = $request->Category_id;
        $drive_Data = $request->file("file");
        if ($drive_Data == null) {
            $file_Name = $drive->file;
            $file_Extination = $drive->file_ext;
        } else {

            //delete old
            $file_name = $drive->file;
            $file_path = public_path("upload/$file_name");
            unlink($file_path);

            $file_Extination = $drive_Data->getClientOriginalExtension();
            $file_Name = $drive_Data->getClientOriginalName();
            $location = public_path() . '/upload';
            $drive_Data->move($location, $file_Name);
        }
        $drive->file = $file_Name;
        $drive->file_ext = $file_Extination;
        $drive->save();
        return redirect()->route('drives.show', $drive->id)->with('done', 'Updated Drive Successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $drive = Drive::find($id);
        $file_name = $drive->file;
        $file_path = public_path("upload/$file_name");
        unlink($file_path);
        $drive->delete();
        return redirect()->route('drives.index')->with('done', 'Drive Deleted Successfully');
    }

    public function download(int $id){

        $drives=drive::find($id);
        $file_name = $drives->file;
                $file_path = public_path("upload/$file_name");
                return response()->download($file_path);
    }
    public  function publicDrives()
    {
        $drives=drive::where('statues','public')->paginate(20);
        return view('drives.public',compact('drives'));

    }
    public function ChangeStatues(int $id)
    {
        $drives=drive::find($id);
if ($drives->statues=='public'){
    $drives->statues='private';
    $drives->save();
    return redirect()->back()->with('done','make file private successfully ');
}
else{
    $drives->statues='public';
    $drives->save();
    return redirect()->back()->with('done','make file public successfully ');
}
    }
}


