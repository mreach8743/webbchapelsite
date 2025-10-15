import React from 'react';

const SubscribePage: React.FC = () => {
  return (
    <div className="py-16">
      <div className="container mx-auto px-4">
        <div className="max-w-2xl mx-auto">
          <h1 className="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-12">
            SUBSCRIBE TO OUR MAILING LIST
          </h1>
          
          <div className="bg-white rounded-lg shadow-lg p-8">
            <form 
              action="https://webbchapel.us19.list-manage.com/subscribe/post?u=ef3a0704edd2aa2978bbac7d3&amp;id=9bca759b78" 
              method="post" 
              id="mc-embedded-subscribe-form" 
              name="mc-embedded-subscribe-form" 
              className="validate" 
              target="_blank" 
              noValidate
            >
              <div className="mb-6">
                <label 
                  htmlFor="mce-EMAIL" 
                  className="block text-lg font-semibold text-gray-700 mb-2"
                >
                  PLEASE ADD YOUR EMAIL ADDRESS TO SUBSCRIBE TO OUR MAILING LIST
                </label>
                <input 
                  type="email" 
                  name="EMAIL" 
                  className="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-church-blue focus:border-transparent" 
                  id="mce-EMAIL" 
                  placeholder="Email Address" 
                  required 
                />
              </div>
              
              {/* Real people should not fill this in and expect good things - do not remove this or risk form bot signups */}
              <div style={{ position: 'absolute', left: '-5000px' }} aria-hidden="true">
                <input 
                  type="text" 
                  name="b_ef3a0704edd2aa2978bbac7d3_9bca759b78" 
                  tabIndex={-1} 
                  defaultValue="" 
                />
              </div>
              
              <div className="text-center">
                <button 
                  type="submit" 
                  name="subscribe" 
                  id="mc-embedded-subscribe" 
                  className="bg-church-blue text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-800 transition-colors"
                >
                  Subscribe
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default SubscribePage;
