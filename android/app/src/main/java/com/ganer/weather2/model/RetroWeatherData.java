package com.ganer.weather2.model;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

/**
 * Created by shim on 15. 1. 20..
 */
public class RetroWeatherData {
    @SerializedName("weathers")
    public ArrayList<WeatherStateItem> states;
    public ArrayList<MessageItem> messages;
    public ArrayList<PictureItem> pictures;

    public static class PictureItem{
        public int season;
        public int state;
        public String img;
    }

    public class MessageItem{
        public int season;
        public int state;
        public String ment;
    }

    public static class WeatherStateItem{
        public int month;
        public int state;
        public int type;
        public String val;
    }

}
