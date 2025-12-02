function fetchData1(callback1) {
    setTimeout(() => {
      console.log("Fetching Data 1...");
      callback1("Data1");
    }, 1000);
  }
  
  function fetchData2(data1, callback2) {
    setTimeout(() => {
      console.log(`Fetching Data 2 using ${data1}...`);
      callback2("Data2");
    }, 1000);
  }
  
  function fetchData3(data2, callback3) {
    setTimeout(() => {
      console.log(`Fetching Data 3 using ${data2}...`);
      callback3("Data3");
    }, 1000);
  }
  
  // Callback Hell
  fetchData1((data1) => {
    fetchData2(data1, (data2) => {
      fetchData3(data2, (data3) => {
        console.log(`Final Data: ${data3}`);
      });
    });
  });
  