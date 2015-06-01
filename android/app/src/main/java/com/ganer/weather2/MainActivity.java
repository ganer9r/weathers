package com.ganer.weather2;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;

import com.ganer.weather2.weather.WeatherActivity;

import org.androidannotations.annotations.App;
import org.androidannotations.annotations.Background;
import org.androidannotations.annotations.EActivity;

@EActivity(R.layout.activity_main)
public class MainActivity extends ActionBarActivity {
    @App
    AppImpl app;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    protected void onResume() {
        super.onResume();
        checkData();
    }

    @Background
    void checkData() {
        app.setWeather();
        moveWeather();

    }


    void moveWeather() {
        Intent intent = new Intent(this, WeatherActivity.class);
        startActivity(intent);

        finish();
    }

}
