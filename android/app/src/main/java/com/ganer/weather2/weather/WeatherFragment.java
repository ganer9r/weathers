package com.ganer.weather2.weather;


import android.graphics.Color;
import android.location.Location;
import android.os.Bundle;
import android.util.Log;
import android.widget.TextView;

import com.ganer.weather2.AppImpl;
import com.ganer.weather2.R;
import com.ganer.weather2.model.RetroWeather;
import com.ganer.weather2.model.RetroWeatherItem;
import com.ganer.weather2.network.ApiService;
import com.ganer.weather2.weather.dao.KmaWeatherDao;
import com.ganer.weather2.weather.dao.WeatherInfo;

import org.androidannotations.annotations.AfterViews;
import org.androidannotations.annotations.App;
import org.androidannotations.annotations.Background;
import org.androidannotations.annotations.EFragment;
import org.androidannotations.annotations.ViewById;

@EFragment(R.layout.fragment_weather_home)
public class WeatherFragment extends android.support.v4.app.Fragment {
    @App
    AppImpl app;
    @ViewById(R.id.message)
    TextView message;
    @ViewById(R.id.wfKor)
    TextView wfKor;
    @ViewById(R.id.temp)
    TextView temp;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @AfterViews
    void afterViews() {
        getWeather();
    }


    @Background
    void getWeather() {
        Location l = app.getCurrentCoords();

        WeatherInfo weatherInfo = new WeatherInfo();
        RetroWeather w = KmaWeatherDao.getCoords(app.getPref().weatherCoords(), app.getRest(), l);
        weatherInfo.setInfo(app, w);

        this.message.setText( weatherInfo.getMessage() );

        RetroWeatherItem currWeather = w.weather.items.get(0);
        this.wfKor.setText( currWeather.wfKor );
        this.temp.setText(w.weather.items.get(0).temp + "");
        if(currWeather.temp < 0) {
            temp.setTextColor(Color.rgb(100, 100, 200));
        }
    }
}