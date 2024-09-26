                                                                             //history.replaceState(stateObj, title, [url])
        /*klikom na submit kontrolu prosledjujemo podatke bazi,  
        bez ove logike, pritiskom na f5 ce se stalno prosledjivati isti podaci bazi.*/           //stateObj-The state object is a JavaScript object which is associated with the history entry passed to the replaceState method. The state object can be null.
            if ( window.history.replaceState )                                                   //title-Most browsers currently ignore this parameter, although they may use it in the future. Passing the empty string here should be safe against future changes to the method. Alternatively, you could pass a short title for the state.
            {                                                                                    //Url-window.location.href returns the href (URL) of the current page
                window.history.replaceState( null, "", window.location.href );                       
            }

