# URL Shortening Service
Welcome to the URL Shortening Service API Documentation

## Encode
Accepts a URL in its request body, encodes it and returns a shortened URL consisting of the site's base URL and a unique, 6 character query string
that can then be decoded by the Decode method of this API.

**URL**: `/api/encode`

**METHOD**: `POST`

### RESPONSE (SUCCESS):

**STATUS CODE**: 200 OK

**CONDITION**: Input Successfully Encoded

**CONTENT**:
``` 
{
   shortUrl: <ENCODED_URL>
} 
```


## Decode
Accepts a full URL or a 6 character identifier provided by the Encode function of the API and returns the original long URL used to generate it.

**URL**: `/api/decode`

**METHOD**: `GET`

### RESPONSE (SUCCESS):

**STATUS CODE**: 200 OK

**CONDITION**: Input Successfully Decoded

**CONTENT**:
``` 
{
   longURL: <DECODED_URL>
} 
```




