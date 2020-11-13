<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AreasRepositoryInterface;
use App\Repositories\Interfaces\DaysRepositoryInterface;
use App\Repositories\Interfaces\AreaDayTimeSlotsRepositoryInterface;
use App\Repositories\Interfaces\AreaDateRangeTimeSlotsRepositoryInterface;
use App\Repositories\Interfaces\SlotsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AreaTimeSlotsController extends Controller
{
    private $areaDayTimeSlotsRepository;
    private $daysRepository;
    private $areaDateRangeTimeSlotsRepository;
    private $slotsRepository;
    private $areasRepository;

    public function __construct(DaysRepositoryInterface $daysRepository, SlotsRepositoryInterface $slotsRepository, AreaDayTimeSlotsRepositoryInterface $areaDayTimeSlotsRepository, AreaDateRangeTimeSlotsRepositoryInterface $areaDateRangeTimeSlotsRepository, AreasRepositoryInterface $areasRepository)
    {
        $this->areaDayTimeSlotsRepository = $areaDayTimeSlotsRepository;
        $this->daysRepository = $daysRepository;
        $this->areaDateRangeTimeSlotsRepository = $areaDateRangeTimeSlotsRepository;
        $this->slotsRepository = $slotsRepository;
        $this->areasRepository = $areasRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $area = $this->areasRepository->edit($id);
        $day_id = $request->query('d_id');
        $days = $this->daysRepository->all([]);
        if ( empty($day_id) ) {
            foreach ($days as $day) {
                $day_id = $day['id'];
                break;
            }
        }
        $time_slots = $this->slotsRepository->all([]);
        $daySlotPriceData = $this->areaDayTimeSlotsRepository->edit($id, $day_id);
        $slotPrice = array();
        foreach ($daySlotPriceData as $daySlotPrice) {
            if ( $daySlotPrice['price'] > 0 ) {
                $slotPrice[$daySlotPrice['slot_id']] = $daySlotPrice['price'];
            }
        }
        return view('admin.areas.time_slots.index', compact('days', 'area', 'slotPrice', 'time_slots', 'day_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->areaDayTimeSlotsRepository->update($request->all(), $id);
        if ( Session::has('error') ) {
            return Redirect::back()->withInput($request->all());
        }
        $url = route('areas.timeslot', $id) . '?d_id=' . $request->get('day_id');
        return redirect($url)->with('success', 'Successfully updated.');
    }

    public function date_range(Request $request, $id)
    {
        $area = $this->areasRepository->edit($id);
        $cond['keyword'] = $request->query('search');
        $cond['area_id'] = $id;
        $ranges = $this->areaDateRangeTimeSlotsRepository->all($cond);
        return view('admin.areas.time_slots.date.index', compact('ranges', 'area'));
    }

    public function date_range_create($id)
    {
        $area = $this->areasRepository->edit($id);
        $time_slots = $this->slotsRepository->all([]);
        return view('admin.areas.time_slots.date.create', compact('time_slots', 'area'));
    }

    public function date_range_store(Request $request, $id)
    {
        $validateData = [
            'name' => ['required', 'min:3', 'max:255'],
            'date_range' => ['required'],
            'active' => 'required',
        ];

        request()->validate($validateData);
        $this->areaDateRangeTimeSlotsRepository->store($request->all());
        if ( Session::has('error') ) {
            return Redirect::back()->withInput($request->all());
        }

        return redirect(route('areas.timeslot.date', $id))->with('success', 'Successfully added.');
    }

    public function date_range_edit($id, $r_id)
    {
        $area = $this->areasRepository->edit($id);
        $time_slots = $this->slotsRepository->all([]);
        $date_range_datas = $this->areaDateRangeTimeSlotsRepository->edit($r_id);
        $date_range_data = $date_range_datas[0];
        return view('admin.areas.time_slots.date.edit', compact('date_range_data', 'area', 'time_slots'));
    }

    public function date_range_update(Request $request, $id, $r_id)
    {
        $validateData = [
            'name' => ['required', 'min:3', 'max:255'],
            'date_range' => ['required'],
            'active' => 'required',
        ];
        request()->validate($validateData);
        $this->areaDateRangeTimeSlotsRepository->update($request->all(), $r_id);
        if ( Session::has('error') ) {
            return Redirect::back()->withInput($request->all());
        }
        return redirect(route('areas.timeslot.date', $id))->with('success', 'Successfully updated.');
    }

    public function date_range_destory($id, $r_id)
    {
        $this->areaDateRangeTimeSlotsRepository->delete($r_id);
        return redirect(route('areas.timeslot.date', $id))->with('success', 'Date range slot is successfully deleted');
    }
}
