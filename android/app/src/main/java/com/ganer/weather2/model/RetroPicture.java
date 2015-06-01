package com.ganer.weather2.model;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

/**
 * Created by shim on 15. 1. 8..
 */
public class RetroPicture {
    @SerializedName("picture_date")
    public String date;
    public ArrayList<PictureItem> pictures;

    public static class PictureItem{
        public int season;
        public int state;
        public String img;
        public String name;
        public int id;

        public String toString(){
            return "season: "+season+
                    "; state: "+state+
                    "; img: "+img+
                    "; name: "+name;
        }
    }

}
