<?php

namespace App\Http\Controllers;

use App\Models\jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class jobsController extends Controller
{
    public function index(){
            return view('jobs.index',[
            'jobs' => jobs::latest()->filter(request(['tag','search']))->paginate(10)
        ]);
    }
    public function edit(jobs $job){
        return view('jobs.edit',[
            'job' => $job
        ]);
    }
    public function show(jobs $job){
        return view('jobs.show',[
            'job' => $job
        ]);
    }
    public function create(){
        return view('jobs.create',[

        ]);
    }
    public function manage(){
        return view('jobs.manage',[
            'jobs'=>auth()->user()->jobs()->get()
        ]);
    }

    public function update(Request $request, jobs $job){
        $formFields= $request->validate([
            "title" =>'required',
            'company'=>'required',
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required',
        ]);

        if($request->hasFile('logo') && $request->file('logo') ?? false){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }

        $job->update($formFields);
        Session::flash('success','gig successfuly edited');
        return redirect("/jobs/". $job->id);
    }

    public function store(Request $request){
        $formFields= $request->validate([
            "title" =>'required',
            'company'=>'required',
            'location'=>'required',
            'website'=>'required',
            'email'=>['required','email'],
            'tags'=>'required',
            'description'=>'required',
        ]);

        $formFields['user_id']=auth()->id();

        if($request->hasFile('logo')){
            $formFields['logo']=$request->file('logo')->store('logos','public');
        }

        jobs::create($formFields);
        Session::flash('success','gig successfuly created');
        return redirect('/');
    }

    public function destroy(jobs $job){
        $job->delete();
        return redirect('/')->with('success','listing successfully deleted');
    }
}
