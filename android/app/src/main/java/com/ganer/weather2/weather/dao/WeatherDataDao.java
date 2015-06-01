package com.ganer.weather2.weather.dao;

import android.util.Log;

import com.ganer.weather2.model.RetroWeatherData;
import com.ganer.weather2.network.ApiService;
import com.google.gson.Gson;

import org.androidannotations.api.sharedpreferences.StringPrefField;

/**
 * Created by shim on 15. 1. 30..
 */
public class WeatherDataDao {
    static RetroWeatherData mData = null;

    public static RetroWeatherData get(StringPrefField pref, ApiService api){
        RetroWeatherData data = getCached(pref);
        //data = api.getWeatherData(lastDate(data, "st"), lastDate(data, "msg"), lastDate(data, "pic"));

        if(data == null) {
            try {
                data = api.getWeatherData();
                pref.put(new Gson().toJson(data));
                Log.d("weatherData_dao", "loaded - " + data.toString());
            }catch(Exception e){
                Log.d("weatherData_dao", "loaded - weather data error");
            }
        }
        return data;
    }

    public String lastDate(RetroWeatherData data, String type)
    {
        if(data == null) return "";
        String date = "";

        return "";
    }

    public static RetroWeatherData getCached(StringPrefField pref){
        if(mData == null) {
            String v = pref.get();
            RetroWeatherData data = null;

            if (v != "") {
                try {
                    data = new Gson().fromJson(v, RetroWeatherData.class);
                    Log.d("weatherData_dao", "cache - " + v);
                } catch (Exception e) {
                    Log.d("weatherData_dao", "cache - weather data error");
                }
            }

            mData = data;
        }

        return mData;
    }

}
