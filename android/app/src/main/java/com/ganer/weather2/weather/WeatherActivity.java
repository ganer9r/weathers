package com.ganer.weather2.weather;

import android.os.Bundle;

import it.neokree.materialnavigationdrawer.MaterialNavigationDrawer;


public class WeatherActivity extends MaterialNavigationDrawer {

    @Override
    public void init(Bundle savedInstanceState) {
        // check in the styles.xml

        this.addSection(newSection("현재 날씨", new WeatherFragment_()));
        this.addSection(newSection("상황 설정", new StateFragment_()));
        this.addSection(newSection("이미지 설정", new ImageFragment_()));
        this.addSection(newSection("문구 설정", new MessageFragment_()));

        // create bottom section
        this.addBottomSection(newSection("만든이", new MessageFragment_()));
    }
}
