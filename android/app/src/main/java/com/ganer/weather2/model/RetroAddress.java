package com.ganer.weather2.model;

/**
 * Created by shim on 15. 1. 8..
 */
public class RetroAddress {

    public String code;
    public String name1;
    public String name2;
    public String name3;

    public String toString(){
        return "code = "+this.code+
                "; name1 = "+this.name1+
                "; name2 = "+this.name2+
                "; name3 = "+this.name3;
    }
}
