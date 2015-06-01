package com.ganer.weather2.weather.dao;

import android.location.Location;
import android.util.Log;

import com.ganer.weather2.model.RetroWeather;
import com.ganer.weather2.network.ApiService;
import com.google.gson.Gson;

import org.androidannotations.api.sharedpreferences.StringPrefField;

/**
 * Created by shim on 15. 1. 30..
 */
public class KmaWeatherDao {
    static RetroWeather mData = null;

    public static RetroWeather getCoords(StringPrefField pref, ApiService api, Location location){
       //RetroWeather data =  getCachedByCoords(pref);

        //if( isCache(data, location) ){
        //    mData = data;
        //}else{

            try {
                mData = api.getWeather2coord(location.getLatitude()+"", location.getLongitude()+"" );
                pref.put(new Gson().toJson(mData));
                Log.d("weather_dao", "loaded - " + new Gson().toJson(mData));
            }catch(Exception e){
                Log.d("weather_dao", "loaded - coords state error");

                // 에러나는 경우 예전 데이터 사용함.
                // data.setTimeRemove(); //예전 시간정보는 제외하고..
                //mData = data;
            }
        //}

        return mData;
    }

    public static boolean isCache(RetroWeather data, Location location){
        boolean r;

        //이전정보에서 1Km이내는 그냥 사용함.
        if(data == null){
            r = false;
        }else {
            Location preLocation = new Location("pre");

            preLocation.setLatitude(Double.parseDouble(data.latlng.lat));
            preLocation.setLongitude(Double.parseDouble(data.latlng.lng));

            double distance = location.distanceTo(preLocation);
            r = (distance < 1000) ? true : false;

            //data 시간체크 해야함.
        }

        return r;
    }

    public static RetroWeather getCachedByCoords(StringPrefField pref){
        RetroWeather data = null;

        if(mData != null) {
            data = mData;
        }else{
            String v = pref.get();
            if (v != "") {
                try {
                    data = new Gson().fromJson(v, RetroWeather.class);
                    Log.d("weather_dao", "cache - " + v);
                } catch (Exception e) {
                    e.printStackTrace();
                    Log.d("weather_dao", "cache - coords error");
                }
            }
        }

        return data;
    }

}
