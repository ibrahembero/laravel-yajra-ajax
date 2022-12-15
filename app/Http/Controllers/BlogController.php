<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Datatables;
use App\Traits\BlogTrait;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // public function index()
    // {
    //     return view('listing');
    // }
    // public function getBlogs(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Blog::latest()->get();
    //         return Datatables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a>
    //                 <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    //     return view('listing');

    // }

    public function createBlog()
        {
            return view('create');
        }
    public function show($id)
        {
            $blog = Blog::find($id);
            return view('show',compact('blog'));
        }
    public function index(Request $request)
        {

            if ($request->ajax()) {

                $data = Blog::latest()->get();

                return Datatables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row){

                               $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBlog">Edit</a>';

                               $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBlog">Delete</a>';

                                return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
            }

            return view('all');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            //$file_name = $this -> saveImage($request -> image,'images/blogs');
            Blog::updateOrCreate([
                        'id' => $request->blog_id
                    ],
                    [
                        'image' => $request->image,
                        'title' => $request->title,
                        'content' => $request->content,
                        'publish-date' => $request->publish_date,
                        'status' => $request->status
                    ]);

            return response()->json(['success'=>'Blog saved successfully.']);
        }
        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Blog  $blog
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $blog = Blog::find($id);
            return response()->json($blog);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Blog  $blog
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            Blog::find($id)->delete();

            return response()->json(['success'=>'Blog deleted successfully.']);
        }

}
