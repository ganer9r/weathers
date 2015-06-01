package com.ganer.weather2.model;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

/**
 * Created by shim on 15. 1. 11..
 */
public class RetroWeather {
    @SerializedName("dong")
    public String dongCode;
    public RetroLatlng latlng;
    public RetroWeatherInfo weather;

    public boolean isNowRain(){
        double pty = this.get(0).pty;

        if(pty == 1)
            return true;
        return false;
    }

    public boolean isWillRain(){
        double pty1 = this.get(1).pty;
        double pty2 = this.get(2).pty;

        if(pty1 == 1 || pty2 == 1)
            return true;
        return false;
    }

    public boolean isWind(){
        double wind = this.get(0).ws;
        if(wind > 2.0)
            return true;

        return false;
    }

    public boolean isCold(String temp){
        float t = Float.parseFloat(temp);
        float nowTemp = this.get(0).temp;

        if(nowTemp < t)
            return true;
        return false;
    }

    public boolean isHot(String temp){
        float t = Float.parseFloat(temp);
        float nowTemp = this.get(0).temp;

        if(nowTemp > t)
            return true;
        return false;
    }

    public RetroWeatherItem get(int idx){
        return weather.items.get(idx);
    }




    public class RetroLatlng{
        public String lat;
        public String lng;
    }

    public class RetroWeatherInfo{
        public String address;
        public String ymdh;
        public ArrayList<RetroWeatherItem> items;
    }
}
