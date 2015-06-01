package com.ganer.weather2.model;

import com.google.gson.annotations.SerializedName;

import java.util.ArrayList;

/**
 * Created by shim on 15. 1. 8..
 */
public class RetroMessage {
    @SerializedName("message_date")
    public String date;
    public ArrayList<MessageItem> messages;

    public class MessageItem{
        public int id;
        public int season;
        public int state;
        public String ment;
    }
}
