/**
 * Helpers
 * @param itemsdata
 * @returns price
 */
function getTotalBarang(barangSelected) {
  return barangSelected.length;
}

function getJumlahItem(barangSelected) {
  let JumlahItem = 0;
  barangSelected.forEach((barang) => {
    JumlahItem = JumlahItem + barang.qty;
  });

  return JumlahItem;
}

function getTotalHarga(TotalHarga) {
  return TotalHarga;
}
function getJumlahPembayaran(JumlahPembayaran) {
  return JumlahPembayaran;
}
function getKembalian(TotalHarga, JumlahPembayaran) {
  let Kembalian =
    TotalHarga >= JumlahPembayaran ? 0 : JumlahPembayaran - TotalHarga;

  return Kembalian;
}
const getTanggal = () => {
  let today = new Date();
  let dd = String(today.getDate()).padStart(2, "0");
  let mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
  let yyyy = today.getFullYear();

  today = yyyy + "-" + mm + "-" + dd;
  return today;
};
/**
 * End Helpers
 */
const Nota = ({ dataitems, id_penjualan }) => {
  return (
    <div className="border border-primary p-2 rounded  shadow-sm">
      <div className="d-flex justify-content-between align-items-center mx-2 ">
        <h5>Transaksi</h5>
        <div className="">
          <span className="mr-1">{getTanggal()}</span>
          <span>No. {id_penjualan}</span>
        </div>
      </div>
      <hr className="m-0" />
      <table className="table table-borderless  text-center">
        <thead>
          <tr>
            <th>Total Barang</th>
            <th>Jumlah Item</th>
            <th>Total Harga</th>
            <th>Jumlah Pembayaran</th>
            <th>Kembalian</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              {dataitems.totalbarang
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",") ?? 0}
            </td>
            <td>
              {dataitems.jumlahitem
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",") ?? 0}
            </td>
            <td>
              {dataitems.totalharga
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",") ?? 0}
            </td>
            <td>
              {dataitems.jumlahbayar
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",") ?? 0}
            </td>
            <td>
              {dataitems.uangkembali
                .toString()
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",") ?? 0}
            </td>
          </tr>
        </tbody>
      </table>
      <hr />
    </div>
  );
};
const SendDataPenjualan = async (data) => {
  const response = await fetch(
    "http://localhost:8080/kasir/konfirmasipembayaran",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Access-Control-Allow-Origin": "*",
      },
      body: JSON.stringify(data),
    }
  );
  const respon = await response.json();
  return respon.message;
};
const DataList = (data) => {
  return (
    <select className="form-control col-lg-6" id="OptionFieldName">
      <option selected>Pilih Barang</option>
      {data.length > 0 &&
        data.map((barang, index) => {
          return (
            <option key={index} value={barang.nama_barang}>
              {barang.nama_barang}
            </option>
          );
        })}
    </select>
  );
};
const Layout = () => {
  // inisiasi state
  const [trigger, setTrigger] = React.useState(false);
  const [barangName, setBarangName] = React.useState("");
  const [IDBarang, setIDBarang] = React.useState("");
  const [Qty, setQty] = React.useState(1);
  const [barangSelected, setbarangSelected] = React.useState([]);
  const [TotalHarga, setTotalHarga] = React.useState(0);
  const [listBarang, setListBarang] = React.useState([]);
  const [indexBarang, setindexBarang] = React.useState(0);
  const [MaxBarang, setMaxBarang] = React.useState(0);
  const [isLoading, setIsLoading] = React.useState(true);
  const [JumlahBayar, setJumlahBayar] = React.useState(0);
  const [idPenjualan, setIdPenjualan] = React.useState("");
  const [Keterangan, setKeterangan] = React.useState("");

  // badan komponen
  const getListBarang = async () => {
    const response = await fetch("http://localhost:8080/kasir/sistemkasir");
    const data = await response.json();
    setIsLoading(false);
    await setListBarang(data);
  };
  const getIdPenjualan = async () => {
    const response = await fetch("http://localhost:8080/kasir/getidpenjualan");
    const data = await response.json();
    setIsLoading(false);
    await setIdPenjualan(data);
  };

  const enterHandler = (e) => {
    if (e.key === "Delete") {
      setTotalHarga(0);
      setTrigger(true);
      let tempbarang = barangSelected.pop();
      if (tempbarang.length == 1) setbarangSelected([]);
      if (tempbarang.length > 1) setbarangSelected(tempbarang);
      let harga = 0;

      if (barangSelected.length > !2) {
        setTotalHarga(barangSelected[0].harga);
      } else {
        barangSelected.forEach((barang) => {
          harga = TotalHarga + barang.harga * barang.qty;
        });
        setTotalHarga(harga);
      }
      setTrigger(true);
    }
    if (e.key === "Enter") {
      let temporary = barangSelected;
      let hargaBarang;
      let namaBarang;
      listBarang.filter((barang) => {
        if (barang.id_barang === IDBarang) {
          namaBarang = barang.nama_barang;
          hargaBarang = parseInt(barang.harga);
        }
      });
      let barangObject = {
        id_barang: IDBarang,
        id_penjualan: idPenjualan.id_penjualan,
        nama_barang: namaBarang,
        qty: Qty,
        harga: hargaBarang,
        total: hargaBarang * Qty,
      };
      temporary.push(barangObject);
      setbarangSelected(temporary);
      let harga = 0;
      setTotalHarga(0);
      if (barangSelected < 2) {
        setTotalHarga(barangSelected[0].harga);
      } else {
        barangSelected.forEach((barang) => {
          harga = TotalHarga + barang.harga * barang.qty;
        });
        setTotalHarga(harga);
      }
      setTrigger(true);
      setBarangName("");
      setQty(1);
      document.getElementById("barang").focus();
    }
  };
  React.useEffect(() => {
    getListBarang();
    getIdPenjualan();
  }, [trigger]);
  if (isLoading) return <h1>Loading...</h1>;
  return (
    <div className="row kasir-container border border-primary rounded overflow-hidden shadow-sm">
      <div className="col-md-3  list-barang  bg-dark">
        <table className="table-dark table table-borderless" id="kasirTable">
          <thead className="text-center">
            <tr>
              <th>Nama Barang</th>
              <th>Qty</th>
              <th>Harga</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            {barangSelected &&
              barangSelected.map((barang, index) => {
                return (
                  <tr key={index}>
                    <td>{barang.nama_barang}</td>
                    <td>{barang.qty}</td>
                    <td>
                      {(barang.harga * barang.qty)
                        .toString()
                        .replace(/\B(?=(\d{3})+(?!\d))/g, ", ")}
                    </td>
                  </tr>
                );
              })}
          </tbody>
        </table>
        <div className="input-barang  rounded">
          <input
            list="barangs"
            autoFocus
            name="barang"
            id="barang"
            placeholder="Masukan Barang"
            className="px-2 py-1 border w-75 form-control-lg rounded-0"
            value={barangName}
            onChange={(e) => {
              setTrigger(false);
              setBarangName(e.target.value); //this Change
              setIDBarang(e.target.value);
              let Indexbarang = listBarang.findIndex(
                (barang) => barang.id_barang == IDBarang
              );
              setindexBarang(Indexbarang);
              listBarang[indexBarang] &&
                setMaxBarang(listBarang[indexBarang].stok);
            }}
            onKeyDown={enterHandler}
          />
          <datalist id="barangs">
            {listBarang.length > 0 &&
              listBarang.map((barang, index) => {
                return (
                  <option key={index} value={barang.id_barang}>
                    {barang.nama_barang}
                  </option>
                );
              })}
          </datalist>
          <input
            type="number"
            name="qty"
            id="qty"
            min="1"
            max={MaxBarang}
            className="px-2 py-1 border w-25 form-control-lg rounded-0"
            style={{ width: 100 + "px" }}
            value={Qty ?? 1}
            onChange={(e) => {
              setTrigger(false);
              let num = e.target.value && parseInt(e.target.value);
              num = num > MaxBarang ? MaxBarang : num;
              setQty(num);
            }}
            onKeyDown={enterHandler}
          />
        </div>
      </div>
      <div className="col-md-9 rounded p-2 ">
        <div className="border rounded bg-success  text-white px-2 pt-2 pb-3 shadow-sm h-10">
          <div className="">Total Harga</div>
          <h1 className="d-block d-flex justify-content-center align-items-center h-100">
            Rp. {TotalHarga.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ", ")}
          </h1>
        </div>
        <div className="input-group my-3 shadow-sm">
          <span className="input-group-text rounded-0" id="basic-addon1">
            Rp.
          </span>
          <input
            aria-describedby="basic-addon1"
            className="form-control form-control-lg"
            type="number"
            placeholder="Jumlah Pembayaran"
            onChange={(e) => {
              setJumlahBayar(e.target.value);
            }}
            value={JumlahBayar}
          />
        </div>
        <Nota
          dataitems={{
            totalbarang: getTotalBarang(barangSelected),
            jumlahitem: getJumlahItem(barangSelected),
            totalharga: getTotalHarga(TotalHarga),
            jumlahbayar: getJumlahPembayaran(JumlahBayar),
            uangkembali: getKembalian(
              getTotalHarga(TotalHarga),
              getJumlahPembayaran(JumlahBayar)
            ),
          }}
          id_penjualan={idPenjualan.id_penjualan}
        />
        <div className="my-2 shadow-sm">
          <input
            aria-describedby="basic-addon1"
            className="form-control form-control"
            type="text"
            placeholder="Keterangan"
            onChange={(e) => {
              setKeterangan(e.target.value);
            }}
            value={Keterangan}
          />
        </div>
        <div className="d-flex justify-content-between mt-2">
          <ul className="w-50">
            <li>
              Tekan ENTER dikolom "masukan barang" atau "jumlah barang" untuk
              menambahkan barang
            </li>
            <li>
              Tekan DELETE dikolom "masukan barang" atau "jumlah barang" untuk
              menghapus barang
            </li>
            <li>Print setelah transaksi dikonfirmasi</li>
          </ul>
          <div className="">
            <form action="print" method="post" className="d-inline">
              {barangSelected &&
                barangSelected.map((barang, index) => {
                  return (
                    <div className="invisible" key={index}>
                      <input
                        type="hidden"
                        name={"indeks-" + (parseInt(index) + 1)}
                        value={barang.nama_barang}
                      />
                      <input
                        type="hidden"
                        name={"qty-" + (parseInt(index) + 1)}
                        value={barang.qty}
                      />
                      <input
                        type="hidden"
                        name={"harga-" + (parseInt(index) + 1)}
                        value={barang.harga}
                      />
                    </div>
                  );
                })}
              {getTotalBarang(barangSelected) > 0 && (
                <input
                  type="hidden"
                  name="totalbarang"
                  value={getTotalBarang(barangSelected)}
                />
              )}
              {getJumlahItem(barangSelected) > 0 && (
                <input
                  type="hidden"
                  name="jumlahitem"
                  value={getJumlahItem(barangSelected)}
                />
              )}
              {getTotalHarga(TotalHarga) > 0 && (
                <input
                  type="hidden"
                  name="totalharga"
                  value={getTotalHarga(TotalHarga)}
                />
              )}
              {getJumlahPembayaran(JumlahBayar) > 0 && (
                <input
                  type="hidden"
                  name="jumlahbayar"
                  value={getJumlahPembayaran(JumlahBayar)}
                />
              )}
              {getKembalian(
                getTotalHarga(TotalHarga),
                getJumlahPembayaran(JumlahBayar)
              ) > 0 && (
                <input
                  type="hidden"
                  name="uangkembali"
                  value={getKembalian(
                    getTotalHarga(TotalHarga),
                    getJumlahPembayaran(JumlahBayar)
                  )}
                />
              )} 
              {getKembalian(
                getTotalHarga(TotalHarga),
                getJumlahPembayaran(JumlahBayar)
              ) == 0 && (
                <input
                  type="hidden"
                  name="uangkembali"
                  value={0}
                />
              )}
            
              <input type="hidden" name="tgl_penjualan" value={getTanggal()} />
              {idPenjualan.id_penjualan && (
                <input
                  type="hidden"
                  name="id_penjualan"
                  value={idPenjualan.id_penjualan}
                />
              )}
              <button className="btn btn-primary " type="submit">
                <i className="fas fa-print mr-2"></i>Print
              </button>
            </form>
            <button
              className="btn btn-success ml-2"
              onClick={async () => {
                let tempdataPenjualan = {
                  id_penjualan: idPenjualan.id_penjualan,
                  tgl_penjualan: getTanggal(),
                  keterangan: Keterangan,
                  total_jual: TotalHarga
                };

                let datafix = [tempdataPenjualan, barangSelected];
                let message = await SendDataPenjualan(datafix);
                alert(await message);

                document.getElementById("barang").focus();
              }}
            >
              Konfirmasi Pembayaran
            </button>
          </div>
        </div>
      </div>
    </div>
  );
};

// main component

const App = () => {
  return (
    <>
      <Layout />
    </>
  );
};

const app = document.getElementById("kasirPage");
if (app) {
  const root = ReactDOM.createRoot(app);
  root.render(<App />);
}
