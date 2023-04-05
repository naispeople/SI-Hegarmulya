const JamComponent = document.querySelector("#jam");
const TanggalComponent = document.querySelector("#ttl");
let i = 0;
const Tanggal = new Date().toLocaleDateString("en-US", {
  timeZone: "Asia/Jakarta",
});
const UpdateClock = () => {
  const Waktu = new Date().toLocaleTimeString("en-US", {
    hour12: false,
    hour: "2-digit",
    minute: "2-digit",
    timeZone: "Asia/Jakarta",
  });

  JamComponent.innerHTML = Waktu;
};
UpdateClock();
setInterval(UpdateClock, 6000);

const getMonthName = (Month) => {
  let MonthName;
  switch (Month) {
    case 0:
      MonthName = "Januari";
      break;
    case 1:
      MonthName = "Februari";
      break;
    case 2:
      MonthName = "Maret";
      break;
    case 3:
      MonthName = "April";
      break;
    case 4:
      MonthName = "Mei";
      break;
    case 5:
      MonthName = "Juni";
      break;
    case 6:
      MonthName = "Juli";
      break;
    case 7:
      MonthName = "Agustus";
      break;
    case 8:
      MonthName = "September";
      break;
    case 9:
      MonthName = "Oktober";
      break;
    case 10:
      MonthName = "November";
      break;
    case 11:
      MonthName = "Desember";
      break;
    default:
      break;
  }
  return MonthName;
};

const dateHelper = (date) => {
  const dateData = new Date(date);
  const DayNameList = [
    "Minggu",
    "Senin",
    "Selasa",
    "Rabu",
    "Kamis",
    "Jumat",
    "Sabtu",
  ];
  const DayName = DayNameList[dateData.getDay()];
  const DateDay = dateData.getDate();
  const Month = getMonthName(dateData.getMonth());
  const Year = dateData.getFullYear();
  const FormattedDate = `${DayName}, ${DateDay} ${Month} ${Year}`;
  return FormattedDate;
};

TanggalComponent.innerHTML = dateHelper(Tanggal);
