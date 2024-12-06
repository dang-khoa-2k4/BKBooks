
import logoBK from "../../Assert/images/bachkhoa.png"

const Footer = () => {
    return (
        <>
            <div className="grid grid-cols-3 gap-4 p-10" style={{background:"#ED553B"}}>
            {/* First div takes 1 column */}
            <div className="p-4">
                <img  src={logoBK} />
                <p className="text-white">Nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                <div>
                    <ul class="flex space-x-4 text-color">
                        <li><i class="fa-brands fa-facebook text-2xl text-white"></i></li>
                        <li><i class="fa-brands fa-instagram text-2xl text-white"></i></li>
                        <li><i class="fa-brands fa-linkedin text-2xl text-white"></i></li>
                        <li><i class="fa-brands fa-twitter text-2xl text-white"></i></li>
                        <li><i class="fa-brands fa-blogger-b  text-2xl text-white"></i></li>
                    </ul>   
                </div>
            </div>

            {/* Second div takes 1 column */}
            <div className="p-4">
                <p className="text-white text-3xl">Company</p>
                <div>
                    <ul class="flex flex-col">
                        <li className="text-xl text-white">HOME</li>
                        <li className="text-xl text-white">ABOUT US</li>
                        <li className="text-xl text-white">BOOKS </li>
                        <li className="text-xl text-white">NEW RELEASE</li>
                        <li className="text-xl text-white">CONTACT US</li>
                        <li className="text-xl text-white">BLOG</li>

                    </ul>
                </div>
            </div>

            {/* Third div takes 1 column */}
            <div className="p-4">
                <p className="text-white text-3xl">Importent Links</p>
                <div>
                    <ul class="flex flex-col">
                        <li className="text-xl text-white">Privacy Policy</li>
                        <li className="text-xl text-white">FAQs</li>
                        <li className="text-xl text-white">Terms of Service </li>
                    </ul>
                </div>
            </div>

            <div className="w-full col-span-3 p-3 flex justify-between text-white"> 
                <div>
                    © 2024 BK BOOKS. All Rights Reserved.
                </div>
                <div>
                    
                Privacy | Terms of Service
                </div>
            </div>
        </div>
        
        </>
        
    );
}

export default Footer;
