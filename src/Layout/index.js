import Header from "../components/Header";
import Sidebar from "../components/Sidebar";
import Main from "../components/Main";
import "./index.css"

const LayoutDefault = () => {
    return (
        <div>
            <Header />
            <Sidebar/>
            <Main />
        </div>
    );
}

export default LayoutDefault;
