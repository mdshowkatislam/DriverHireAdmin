<?php

namespace App\Http\Controllers;


use Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class NotificationTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = DB::table('notification_templates');
        $search = request()->query('search');

        if ( $search ){
            $notifications = $notifications->where('template_subject', 'LIKE', "%{$search}%")->orWhere('template_body', 'LIKE', "%{$search}%");
        }

        $notifications = $notifications->orderBy('id', 'DESC')->Paginate(15);


        return view('notification.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function list()
    {
        $notifications = DB::table('notifications')->orderBy('id', 'DESC')->Paginate(15);

        return view('notification.list', compact('notifications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $insertData = [
            'template_subject' => $request->template_subject,
            'template_body' => $request->template_body,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        DB::table('notification_templates')->insert($insertData);

        Toastr::success('Notification Template Created Successfully');

        return redirect()->route('notification.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $notification = DB::table('notification_templates')->where('id', $id)->first();

        return sendResponse(
            'Edit Notification Template',
            [
                'view' => view('notification.edit', compact('notification'))->render()
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            DB::table('notification_templates')->where('id', $id)->update([
                'template_subject' => $request->template_subject,
                'template_body' => $request->template_body,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            Toastr::info('Notification Template Updated Successfully');

            return redirect()->route('notification.index');
        } catch (\Exception $e) {
            Toastr::error('Something went wrong');

            return redirect()->route('notification.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DB::table('notification_templates')->where('id', $id)->delete();

        Toastr::warning('Notification Template Deleted Successfully');

        return redirect()->route('notification.index');
    }


    public function listDelete($id)
    {
        DB::table('notifications')->where('id', $id)->delete();
        Toastr::warning('Notification Deleted Successfully');

        return redirect()->route('notification.list');
    }
}
