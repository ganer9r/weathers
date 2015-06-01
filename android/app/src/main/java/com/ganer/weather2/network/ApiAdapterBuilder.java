package com.ganer.weather2.network;

import retrofit.RestAdapter;

/**
 * Created by shim on 15. 1. 8..
 */
public class ApiAdapterBuilder {
    private static ApiService mDaumService;

    public static ApiService getApiAdapter(){
        if(ApiAdapterBuilder.mDaumService == null) {
            RestAdapter adapter = new RestAdapter.Builder()
                    .setEndpoint(ApiService.END_POINT)
                    .setLogLevel(RestAdapter.LogLevel.FULL)
                    .build();
            ApiAdapterBuilder.mDaumService = adapter.create(ApiService.class);
        }

        return ApiAdapterBuilder.mDaumService;
    }
}
