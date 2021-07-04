# URL Shortening Service
Welcome to the URL Shortening Service API Documentation

## Encode
Accepts a URL in its request body, encodes it and returns a shortened URL consisting of the site's base URL and a unique,
6 character (by default) query string that can then be decoded by the Decode method of this API.

**URL**: `/api/shortener/encode`

**Method**: `POST`

**Content Type**: `application\json`

**Parameters**: `urlToEncode` where the URL to encode is the URL to be shortened.

**Request Headers Example**:
```
Content-Type: application/json
Accept: */*
Host: url_shortening_service
Content-Length: 233
```

**Request Body Example**: 
```
{
    "urlToEncode":"www.snuggle.com/marketing/my_amazing_campagin/extreme_pillows_deal"
}
```

### RESPONSE (SUCCESS):

**Status Code**: 200 OK

**Condition**: Input Successfully Encoded.

**Content**:
``` 
{
    "shortenedUrl": "http://url_shortening_service/YTlkMT"
}
```

### RESPONSE (FAILURE):

**Status Code**: 400 Bad Request

**Condition**: Input Could Not Be Encoded.

**Content**:
``` 
{} 
```


## Decode
Accepts a full URL or a 6 character (by default) identifier provided by the Encode function of the API and returns the original long URL used to generate it.

**URL**: `/api/shortener/decode`

**Method**: `POST`

**Content Type**: `application\json`

**Parameters**: `urlToDecode` where the URL to decode is the IDENTIFIER or the LONG URL.

**Request Headers Example**:
```
Content-Type: application/json
Accept: */*
Host: url_shortening_service
Content-Length: 62
```

**Request Body Examples**:
```
{
    "urlToDecode":"YTlkMT"
}
```
```
{
    "urlToDecode":"http://url_shortening_service/YTlkMT"
}
```
### RESPONSE (SUCCESS):

**Status Code**: 200 OK

**Condition**: Input Successfully Decoded.

**Content**:
``` 
{
    "decodedUrL":"www.snuggle.com\/marketing\/my_amazing_campagin\/extreme_pillows_deal"
}
```

### RESPONSE (FAILURE):

**Status Code**: 400 BAD REQUEST

**Condition**: The inputted URL was not valid.

**Content**:
``` 
{} 
```

### RESPONSE (FAILURE):

**Status Code**: 404 NOT FOUND

**Condition**: The inputted URL could not be found.

**Content**:
``` 
{} 
```




