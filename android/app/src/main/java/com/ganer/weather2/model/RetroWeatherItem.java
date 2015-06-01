package com.ganer.weather2.model;

import com.google.gson.annotations.SerializedName;

/**
 * Created by shim on 15. 1. 13..
 */
public class RetroWeatherItem {
    public int hour;
    public int day;
    public float temp;
    @SerializedName("tmx")
    public float maxTemp;
    @SerializedName("tmn")
    public float minTemp;
    public int sky;
    public int pty; //강수상태

    public String wfKor;    //날씨 한글
    public String wfEn;     //날씨 영

    public int pop;         //강수 확률
    public float ws;       //풍속
    @SerializedName("wdEn")
    public String wd;        //풍향En":"N","
    public int reh;         //습도

}
