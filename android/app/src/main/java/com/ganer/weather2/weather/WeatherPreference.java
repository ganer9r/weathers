package com.ganer.weather2.weather;

import org.androidannotations.annotations.sharedpreferences.DefaultString;
import org.androidannotations.annotations.sharedpreferences.SharedPref;

/**
 * Created by shim on 15. 1. 7..
 */
@SharedPref(value=SharedPref.Scope.UNIQUE)
public interface WeatherPreference {
    @DefaultString("")
    String weather();

    @DefaultString("")
    String weatherCoords();
}