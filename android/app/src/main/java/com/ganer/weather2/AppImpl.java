package com.ganer.weather2;

import android.app.Application;
import android.location.Location;
import android.util.Log;

import com.ganer.weather2.model.RetroWeatherData;
import com.ganer.weather2.network.ApiAdapterBuilder;
import com.ganer.weather2.network.ApiService;
import com.ganer.weather2.util.GPSTracker;
import com.ganer.weather2.weather.WeatherPreference_;
import com.ganer.weather2.weather.dao.WeatherDataDao;

import org.androidannotations.annotations.EApplication;
import org.androidannotations.annotations.sharedpreferences.Pref;

/**
 * Created by shim on 15. 1. 8..
 */
@EApplication
public class AppImpl extends Application {
    @Pref
    WeatherPreference_ pref;
    RetroWeatherData weatherData = null;

    String dongCode = "";
    Location mLocation = null;
    ApiService mApiService = null;

    public void setWeather(){
        weatherData = WeatherDataDao.get(getPref().weather(), getRest());
    }

    public RetroWeatherData getWeather(){
        return weatherData;
    }

    public Location getCurrentCoords(){
        return GPSTracker.getLocation(this);
    }


    public void setDongCode(String dongCode){
        this.dongCode = dongCode;
    }

    public String getDongCode(){
        return this.dongCode;
    }

    public ApiService getRest(){
        return ApiAdapterBuilder.getApiAdapter();
    }


    public WeatherPreference_ getPref(){
        return pref;
    }

}
