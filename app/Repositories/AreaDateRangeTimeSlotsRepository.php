<?php

namespace App\Repositories;

use App\Api\APIActions;
use App\Repositories\Interfaces\AreaDateRangeTimeSlotsRepositoryInterface;
use Illuminate\Support\Facades\Session;
use App\Exceptions\ApiException;

class AreaDateRangeTimeSlotsRepository implements AreaDateRangeTimeSlotsRepositoryInterface
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
        $url = '/getGlobalDateRangeSlots';
        $url .= !empty($q) ? '?' . $q : '';
        $result = $this->get($url, $cond, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function store($data)
    {
        $result = $this->post('/time_slots/global/date/create', $data, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function edit($id)
    {
        $result = $this->get('/getGlobalDateSlot/' . $id, [], [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function update($data, $id)
    {
        $result = $this->post('/time_slots/global/date/update/' . $id, $data, [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

    public function delete($id)
    {
        $result = $this->post('/time_slots/global/date/delete/' . $id, [], [self::TOKEN => Session::get(self::API_TOKEN)]);
        if ( $result->getStatusCode() == 200 ) {
            return $this->convertToArray($result->getBody());
        }
        return ApiException::customApiResponse($result);
    }

}