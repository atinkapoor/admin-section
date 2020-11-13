<?php

namespace App\Repositories;

use App\Api\APIActions;
use App\Repositories\Interfaces\AreaDayTimeSlotsRepositoryInterface;
use Illuminate\Support\Facades\Session;
use App\Exceptions\ApiException;

class AreaDayTimeSlotsRepository implements AreaDayTimeSlotsRepositoryInterface
{
    use APIActions;

    const TOKEN = 'token';
    const API_TOKEN = 'api_token';

    public function all($cond = array())
    {
        $q = '';
        if ( !empty($cond) ) {
            foreach ($cond as $k => $v) {
                $str = $k . '=' . $v;
                $q .= empty($q) ? $str : '&' . $str;
            }
        }
        $url = '/getGlobalDaySlots';
        $url .= !empty($q) ? '?' . $q : '';
        $result = $this->get($url, $cond, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function edit($area_id,$day_id)
    {
        $result = $this->get('/getGlobalDaySlot/' . $area_id.'/'.$day_id, [], [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function update($data, $id)
    {
        $result = $this->post('/time_slots/global/update/' . $id, $data, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }


}