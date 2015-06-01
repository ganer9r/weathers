package com.ganer.weather2.weather;


import android.os.Bundle;
import android.util.Log;

import com.ganer.weather2.R;

import org.androidannotations.annotations.AfterViews;
import org.androidannotations.annotations.EFragment;

@EFragment(R.layout.fragment_weather_state)
public class StateFragment extends android.support.v4.app.Fragment {

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @AfterViews
    void afterViews() {
        Log.d("load.....", "load..........");
    }
}