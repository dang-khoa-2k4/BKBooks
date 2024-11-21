

import MoonLoader from "react-spinners/ClipLoader";

const override = {
  display: "block",
  margin: "0 auto",
  borderColor: "red",
};

const Loading = () => {
    return (
        <div className="sweet-loading">
            <MoonLoader
                color={""}
                loading={true}
                cssOverride={override}
                size={250}
                aria-label="Loading Spinner"
                data-testid="loader"
            />
        <h3>Đang đăng nhập xin chờ trông giây lát</h3>
        </div>
    );
}

export default Loading;

