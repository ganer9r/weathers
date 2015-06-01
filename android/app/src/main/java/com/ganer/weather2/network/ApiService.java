package com.ganer.weather2.network;

import com.ganer.weather2.model.RetroAddress;
import com.ganer.weather2.model.RetroMessage;
import com.ganer.weather2.model.RetroPicture;
import com.ganer.weather2.model.RetroWeather;
import com.ganer.weather2.model.RetroWeatherData;

import retrofit.http.GET;
import retrofit.http.Path;


/**
 * Created by shim on 15. 1. 8..
 */
public interface ApiService {
    //static String END_POINT = "http://weather/api";
    static String END_POINT = "http://ganer.gtz.kr/weather/api";

    @GET("/weather/data")
    RetroWeatherData getWeatherData();

    @GET("/picture")
    RetroPicture getPicture();

    @GET("/message")
    RetroMessage getMessage();


    @GET("/kma/codes")
    RetroAddress getDongCodes();

    @GET("/kma/test")
    RetroAddress getTest();

    @GET("/kma/weather/{lat}/{lng}")
    RetroWeather getWeather2coord(@Path("lat") String lat, @Path("lng") String lng);

    /*
    @GET("/kma/weather/code/{code}")
    RetroWeather getWeather2code(String code);
    */
}
