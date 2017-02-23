<?php

namespace App\Jobs\Users;

use App\Mail\UserRegistered;
use File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Image;

class UpdateImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    public $user;
    public $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request, $id)
    {
        $this->user = $request->user();
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fileName = $this->id . '.jpeg';
        $filePath = storage_path() . '/uploads/' . $this->id;

        Image::make($filePath)->encode('jpeg')->fit(60, 60, function($c) {
            $c->upsize();
        })->save();

        if (Storage::disk('s3')->put("images/users/{$fileName}", fopen($filePath, 'r+'))) {
            File::delete($filePath);
        }   

        $this->user->update([
            'image_filename' => $fileName,
        ]); 
         
        Mail::to($this->user)->queue(new UserRegistered($this->user));
    }
}
