const query=async(url)=>{
const res= await fetch(url, {
method: "GET",
headers: {
'Content-Type': 'application/json',
"Authorization": "Basic " + btoa("ck_dbc029e06ebfe7f689b2fe4b8bd78c5a279a7b1b:cs_488c93c99a9179787587f46b3bb25fdc3fc7ed0c")
}});
if(!res.ok) {
const {status, ok} = res;
const msg= await res.json()
return {status, ok, msg};
}
return await res.json();
}
const queryPost=async(url, body)=>{
const res= await fetch(url, {
method: "POST",
body: JSON.stringify(body)
});
if(!res.ok) {
const {status, ok} = res;
const msg= await res.json()
return {status, ok, msg};
}
return await res.json();
}

const Post=async(url, body)=>{
const res= await fetch(url, {
method: "POST",
headers: {
'Content-Type': 'application/json',
"Authorization": "Basic " + btoa("ck_dbc029e06ebfe7f689b2fe4b8bd78c5a279a7b1b:cs_488c93c99a9179787587f46b3bb25fdc3fc7ed0c")
},
body: JSON.stringify(body)
});
if(!res.ok) {
const {status, ok} = res;
const msg= await res.json()
return {status, ok, msg};
}
return await res.json();
}

export { query, queryPost, Post}


