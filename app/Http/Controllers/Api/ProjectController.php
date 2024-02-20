<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectsResource;
use App\Models\Project;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index()
    {
        $posts = Project::latest()->paginate(10);
        return new ProjectsResource(true, 'List Data Projects', $posts);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'category'     => 'required',
            'description'     => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'github_link'   => 'required',
            'project_link'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $image = $request->file('image');
        $image->storeAs('public/projects', $image->hashName());

        $post = Project::create([
            'title'     => $request->title,
            'category'     => $request->category,
            'description'   => $request->description,
            'image'     => $image->hashName(),
            'github_link'   => $request->github_link,
            'project_link'   => $request->project_link,
        ]);

        return new ProjectsResource(true, 'Data Project Berhasil Ditambahkan!', $post);
    }
}
