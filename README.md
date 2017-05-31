# Politifact Proxy

This is an example proxy script for working with the [Politifact API](http://static.politifact.com/api/v2apidoc.html) from a browser. _It is meant 
for instructional purposes only, and should not be used in a production environment with additional security measures._


## Usage

Pass a parameter **_ep** that contains the desired endpoint within the API, beginning with a forward slaash:
```$javascript
jQuery.getJSON("/politifact.php?_ep=/statement/");
```

Any other parameters will be sent to the requested endpoint, so this should allow full access to the API. It is 
currently only meant for making GET requests; any POST/PUT/DELETE requests will fail in unexpected (but spectacular?!) 
ways.

Cheers!
