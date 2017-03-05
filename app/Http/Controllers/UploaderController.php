<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderController extends Controller
{

	// TODO: URL shortener, auto-copy to clipboard after upload

	protected $allowedFormats = [
		'jpeg', 'jpg', 'png'
	];

	public function index($name)
    {
    	if (!Storage::disk('s3Uploader')->exists($this->buildFilePath($name))) {
    		abort(404);
    	}
    	return view('uploader.index')->with([
    		'image' => $this->buildAbsoluteFilePath($name),
    	]);
    }

    public function show() {
    	return view('uploader.show');
    }

    public function create(Request $request)
    {
       	$file = $request->file('image');
       	if (!$file) {
       		return back()->withErrors('No picture provided');
       	}

       	if (!$this->isAllowedFormat($file)) {
       		return back()->withErrors('Invalid format');
       	}

       	$name = str_random(255) . '.' . $file->getClientOriginalExtension();

       	Storage::disk('s3Uploader')->put(
       		$this->buildFilePath($name),
       		file_get_contents($file->getRealPath())
       	);

       	return redirect()->route('showImage', compact('name'));
    }

    protected function isAllowedFormat(UploadedFile $file)
    {
    	return in_array(
    			$file->getClientOriginalExtension(),
    			$this->allowedFormats
    		);
    }

    protected function buildFilePath($name)
    {
    	return 'images/' . $name;
    }

    protected function buildAbsoluteFilePath($name)
    {
    	return 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('S3_UPLOAD_BUCKET') . '/' . $this->buildFilePath($name);
    }
}
