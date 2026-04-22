<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Testimonial;
use Datatables;
use Illuminate\Http\Request;

class TestimonialController extends AdminController
{
    public function __construct()
    {
        view()->share('type', 'testimonial');
    }

    public function index()
    {
        return view('admin.testimonial.index');
    }

    public function create()
    {
        return view('admin.testimonial.create_edit');
    }

    public function store(TestimonialRequest $request)
    {
        $data = $request->except('photo');
        $testimonial = new Testimonial($data);
        $testimonial->save();

        $this->uploadPhotoIfNeeded($request, $testimonial);
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.create_edit', compact('testimonial'));
    }

    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonial.create_edit', compact('testimonial'));
    }

    public function update(TestimonialRequest $request, Testimonial $testimonial)
    {
        $data = $request->except('photo');
        $testimonial->update($data);

        $this->uploadPhotoIfNeeded($request, $testimonial);
    }

    public function delete(Testimonial $testimonial)
    {
        return view('admin.testimonial.delete', compact('testimonial'));
    }

    public function destroy(Testimonial $testimonial)
    {
        $this->deletePhotoIfPresent($testimonial);
        $testimonial->delete();
    }

    public function data()
    {
        $testimonials = Testimonial::select([
            'testimonials.id',
            'testimonials.rank',
            'testimonials.name',
            'testimonials.job_title',
            'testimonials.company',
            'testimonials.created_at',
        ])->orderBy('testimonials.rank')->orderBy('testimonials.name');

        return Datatables::of($testimonials)
            ->add_column('actions', '<a href="{{{ url(\'admin/testimonial/\' . $id . \'/edit\' ) }}}" class="btn btn-success btn-sm iframe" ><span class="glyphicon glyphicon-pencil"></span>  {{ trans("admin/modal.edit") }}</a>
                    <a href="{{{ url(\'admin/testimonial/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger iframe"><span class="glyphicon glyphicon-trash"></span> {{ trans("admin/modal.delete") }}</a>')
            ->remove_column('id')
            ->make();
    }

    private function uploadPhotoIfNeeded(Request $request, Testimonial $testimonial)
    {
        if (!$request->hasFile('photo')) {
            return;
        }

        $file = $request->file('photo');
        if (!$file->isValid()) {
            \Log::warning('Testimonial photo upload is invalid.', ['testimonial_id' => $testimonial->id]);
            return;
        }

        $folder = public_path() . '/images/testimonials';
        if (!is_dir($folder)) {
            @mkdir($folder, 0777, true);
        }

        if (!is_dir($folder)) {
            \Log::error('Unable to create testimonials upload folder.', [
                'folder' => $folder,
                'testimonial_id' => $testimonial->id,
            ]);
            return;
        }

        $fileName = str_random(30) . '.' . $file->getClientOriginalExtension();
        try {
            $file->move($folder, $fileName);
        } catch (\Exception $e) {
            \Log::error('Failed to move testimonial photo upload.', [
                'testimonial_id' => $testimonial->id,
                'folder' => $folder,
                'file_name' => $fileName,
                'message' => $e->getMessage(),
            ]);
            return;
        }

        $previousPhoto = $testimonial->photo;
        $testimonial->update([
            'photo' => $fileName,
        ]);

        if (!empty($previousPhoto)) {
            $previousPath = $folder . DIRECTORY_SEPARATOR . $previousPhoto;
            if (file_exists($previousPath)) {
                unlink($previousPath);
            }
        }
    }

    private function deletePhotoIfPresent(Testimonial $testimonial)
    {
        if (empty($testimonial->photo)) {
            return;
        }

        $path = public_path('images/testimonials/' . $testimonial->photo);
        if (file_exists($path)) {
            unlink($path);
        }
    }
}
