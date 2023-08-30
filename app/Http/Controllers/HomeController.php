<?php

namespace App\Http\Controllers;



class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = dashboardSummery();
        return view('welcome', $data);
    }


    public function chartAJAXRequest()
    {
        $values = array_values(dashboardSummery());
        $data = [
            'labels' => ['Users', 'Drivers', 'Owners', 'Hire Request'],
            'datasets' => [
                [
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                    ],
                    'data' => array_values(dashboardSummery()),
                    'hoverOffset' => 4
                ]
            ]
        ];

        $options = [
            'scales' => [
                'y' => [
                    'suggestedMin' => min($values) ,
                    'suggestedMax' => max($values) ,
                ]
            ]
        ];

        return sendResponse('Chart Data', [
            'data' => $data,
            'options' => $options
        ]);
    }
}
