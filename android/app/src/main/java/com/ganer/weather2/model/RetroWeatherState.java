package com.ganer.weather2.model;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

/**
 * Created by shim on 15. 1. 8..
 */
public class RetroWeatherState {
    @SerializedName("weather_date")
    public String date;
    @SerializedName("weathers")
    public ArrayList<WeatherStateItem> states;

    public static class WeatherStateItem{
        public int month;
        public int state;
        public int type;
        public String val;

        public String toString(){
            return "month = "+this.month+
                    "; state = "+this.state+
                    "; type = "+this.type+
                    "; val = "+this.val;
        }
    }
}
