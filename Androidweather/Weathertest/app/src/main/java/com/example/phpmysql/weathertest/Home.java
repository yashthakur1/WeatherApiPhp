package com.example.phpmysql.weathertest;

import android.content.Context;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;

import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.Request;
import com.android.volley.Request.Method;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.net.HttpURLConnection;
import java.util.HashMap;
import java.util.Map;

public class Home extends AppCompatActivity {

    // JSON Node names
    private static final String TAG_Weather = "weatherDesc";
    private static final String TAG_Condition = "current_condition";
    private static final String TAG_Location = "query";
    private static final String TAG_Humidity = "humidity";
    private static final String TAG_Temperature = "temp_C";
    private static final String TAG = Home.class.getSimpleName();
    JSONArray contacts = null;

    // Variables for activity_home elements
    Button weatherify;
    EditText entercity;
    EditText enterstate;
    TextView locationtext;
    TextView temperaturetext;

    private JSONObject jsonObject;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);



        weatherify = (Button) findViewById(R.id.button);
        entercity = (EditText) findViewById(R.id.entercity);
        enterstate = (EditText) findViewById(R.id.enterstate);
        locationtext=(TextView) findViewById(R.id.locationtext);
        temperaturetext = (TextView) findViewById(R.id.temperaturetext);

        weatherify.setOnClickListener(new OnClickListener() {
            @Override
            public void onClick(View v) {

                final String city = entercity.getText().toString();
                final String state = enterstate.getText().toString();

                Log.d(TAG,""+city);
                Log.d(TAG,""+state);

                JsonObjectRequest stringRequest=new JsonObjectRequest(Request.Method.POST,"http://api.worldweatheronline.com/free/v2/weather.ashx?",null,new Response.Listener<JSONObject>(){

                    @Override
                    public void onResponse(JSONObject s)  {

                    Log.d(TAG, "Login Response: " + s.toString());

                     //replace your working json retrieving code here



                    }
                },new Response.ErrorListener(){

                    @Override
                    public void onErrorResponse(VolleyError volleyError) {
                        Log.d(TAG,"ERROR :"+volleyError.getMessage());
                        Toast.makeText(getApplicationContext(),
                                "Error Occured:", Toast.LENGTH_LONG).show();

                    }
                })
                {

                    @Override
                    protected Map<String, String> getParams() {
                        // Posting parameters to URL
                        Map<String, String> params = new HashMap<String, String>();
                        params.put("key", "29ae6fae85e088882d0e163a229cf");// Replace api key with Your api key
                        params.put("q", city+","+state);
                        params.put("format","JSON");

                        return params;
                    }

                    @Override
                    public Map<String, String> getHeaders() throws AuthFailureError {
                        Map<String,String> params = new HashMap<String, String>();
                        params.put("Content-Type","application/x-www-form-urlencoded");
                        return params;
                    }
                };
               RequestQueue queue=Volley.newRequestQueue(getApplicationContext());
                queue.add(stringRequest);
            }
        });


    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_home, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }



}
