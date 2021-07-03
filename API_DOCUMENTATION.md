# URL Shortening Service
Welcome to the URL Shortening Service API Documentation

## Encode
Accepts a URL in its request body, encodes it and returns a shortened URL consisting of the site's base URL and a unique, 6 character query string
that can then be decoded by the Decode method of this API.

**URL**: `/api/shortener/encode`

**Method**: `POST`

### RESPONSE (SUCCESS):

**Status Code**: 200 OK

**Condition**: Input Successfully Encoded.

**Content**:
``` 
{
   encodedUrl: <ENCODED_URL>
} 
```

### RESPONSE (FAILURE):

**Status Code**: 400 Bad Request

**Condition**: Input Successfully Decoded.

**Content**:
``` 
{} 
```


## Decode
Accepts a full URL or a 6 character identifier provided by the Encode function of the API and returns the original long URL used to generate it.

**URL**: `/api/shortener/decode?urlToDecode=<URL_TO_DECODE>`

**Method**: `GET`

**Parameters**: `urlToDecode` where the URL to decode is the IDENTIFIER.

### RESPONSE (SUCCESS):

**Status Code**: 200 OK

**Condition**: Input Successfully Decoded.

**Content**:
``` 
{
   decodedURL: <DECODED_URL>
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




