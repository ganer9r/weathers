package com.ganer.weather2.util;

import android.content.Context;
import android.location.Criteria;
import android.location.Location;
import android.location.LocationManager;
import android.util.Log;

public class GPSTracker {
    public static Location getLocation(Context context){
        LocationManager locationManager = (LocationManager)context.getSystemService(context.LOCATION_SERVICE);

        Criteria criteria = new Criteria();
        criteria.setAccuracy(Criteria.ACCURACY_FINE);
        criteria.setAltitudeRequired(false);
        criteria.setBearingRequired(false);
        criteria.setCostAllowed(true);
        criteria.setPowerRequirement(Criteria.POWER_LOW);

        String provider = locationManager.getBestProvider(criteria, true);
        Log.d("test", provider.toString());
        if(provider==null){
            return null;
        }

        Location location = locationManager.getLastKnownLocation(provider);
        if(location==null)
            return null;

        return location;
    }
}