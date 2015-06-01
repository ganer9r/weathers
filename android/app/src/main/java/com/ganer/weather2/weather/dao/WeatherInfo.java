package com.ganer.weather2.weather.dao;

import android.util.Log;

import com.ganer.weather2.AppImpl;
import com.ganer.weather2.model.RetroWeather;
import com.ganer.weather2.model.RetroWeatherData;

import java.util.ArrayList;
import java.util.Calendar;

/**
 * Created by shim on 15. 1. 14..
 */
public class WeatherInfo {
    int month;
    ArrayList<String> mMessages = new ArrayList<String>();
    ArrayList<String> mImgs = new ArrayList<String>();

    public WeatherInfo(){
        Calendar cal = Calendar.getInstance();
        this.month = cal.get(Calendar.MONTH)+1;
    }

    public int getSeason(){
        int season = 1;
        switch(this.month){
            case 12:
            case 1:
            case 2:
                season = 4; break;
            case 6:
            case 7:
            case 8:
                season = 2; break;
            case 9:
            case 10:
            case 11:
                season = 1; break;
            default:
                season = 1; break;
        }

        return season;
    }

    public void setInfo(AppImpl app, RetroWeather weather){
        RetroWeatherData data = app.getWeather();

        int state = this.getState( weather, data );
        this.setMessages(state, data);
        this.setImgs(state, data);
    }

    public void setMessages(int state, RetroWeatherData weatherData){
        int season = this.getSeason();

        ArrayList<String> messages = new ArrayList<String>();
        for (RetroWeatherData.MessageItem item : weatherData.messages) {
            if(item.state == state && (item.season == season || item.season == 0)) {
                messages.add(item.ment);
            }
        }

        mMessages = messages;
    }

    public void setImgs(int state, RetroWeatherData weatherData){
        int season = this.getSeason();

        ArrayList<String> imgs = new ArrayList<String>();
        for (RetroWeatherData.PictureItem item : weatherData.pictures) {
            if(item.state == state && (item.season == season || item.season == 0)) {
                imgs.add(item.img);
            }
        }

        this.mImgs = imgs;
    }

    public int getState(RetroWeather weather, RetroWeatherData weatherData){
        int st = 0;

        if( weatherData.states == null){
            return 1;
        }

        for (RetroWeatherData.WeatherStateItem stItem : weatherData.states) {
            if(stItem.month > '0' && month != stItem.month) continue;
            if(stItem.type == 2 && weather.isNowRain()){
                //비/눈 올것 같음.
                return 2;
            }else if(stItem.type == 3 && weather.isWillRain()){
                return 3;
            }else if(stItem.type == 4 && weather.isWind()){
                return 4;
            }else if(stItem.type == 5 && weather.isCold(stItem.val)){
                return 5;
            }else if(stItem.type == 6 && weather.isHot(stItem.val)){
                return 6;
            }
        }

        return 1;
    }

    public String getMessage(){
        String message = "";
        if(mMessages.size() > 0) {
            int i = (int) (Math.random()*(mMessages.size()));
            message = mMessages.get(i);
        }else {
            message = "...";
        }

        return message;
    }

    public String getPicture(){
        String pic = "";
        if(mImgs.size() > 0) {
            int i = (int) (Math.random() * (mImgs.size()));
            pic = mImgs.get(i);
        }
        return pic;
    }
}
