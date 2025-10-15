import React from 'react';
import { BookOpen, Mail, Clock, Users } from 'lucide-react';
import CognitoForm from '../components/CognitoForm';

const SitbPage: React.FC = () => {
  return (
    <div className="w-full">
      {/* Hero Section */}
      <div className="bg-gradient-to-r from-church-blue to-blue-800 text-white py-16">
        <div className="container mx-auto px-4">
          <div className="text-center">
            <h1 className="text-4xl md:text-5xl font-bold mb-4">
              SITB - Studies in the Bible
            </h1>
            <p className="text-xl md:text-2xl text-blue-100">
              Deepen your understanding of God's Word
            </p>
          </div>
        </div>
      </div>

      <div className="container mx-auto px-4 py-12">
        {/* Logo Section */}
        <div className="text-center mb-12">
          <div className="bg-white rounded-lg shadow-lg p-8 max-w-2xl mx-auto">
            <img 
              src="/images/sitb-logo.png" 
              alt="SITB Logo" 
              className="mx-auto mb-6 max-w-full h-auto"
            />
          </div>
        </div>

        {/* Main Content */}
        <div className="max-w-4xl mx-auto">
          <div className="bg-white rounded-lg shadow-lg p-8 mb-8">
            <div className="prose prose-lg max-w-none">
              <p className="text-lg text-gray-700 leading-relaxed mb-6">
                "Hello and welcome to our Bible correspondence ministry called Studies in the Bible (SITB). 
                If you are interested in a detailed study of God's word, you've found the right ministry to do just that.
              </p>
              
              <p className="text-lg text-gray-700 leading-relaxed mb-6">
                This is a 30 lesson series and we send you 3 lessons at a time which you can complete on your own timeframe. 
                We will not contact you in any way other than sending you the next lessons in the series.
              </p>
              
              <p className="text-lg text-gray-700 leading-relaxed mb-6">
                There is absolutely no cost to you as we also include self-addressed stamped envelopes for you to return 
                3 lessons after you have answered the study questions for each lesson. We will check your knowledge 
                of what you've studied and return the graded lessons with 3 new lessons.
              </p>
              
              <p className="text-lg text-gray-700 leading-relaxed">
                No matter what your level of knowledge of the Bible is, I think you will benefit from this study."
              </p>
            </div>
          </div>

          {/* Sign Up Form */}
          <div className="bg-white rounded-lg shadow-lg p-8">
            <h2 className="text-2xl font-bold text-gray-800 mb-6 text-center">
              Sign Up for the Course
            </h2>
            
            <div className="bg-gray-50 rounded-lg p-6">
              <CognitoForm 
                dataKey="V3ZbR_hZIEKuz9M3qRqiEA"
                dataForm="94"
              />
            </div>
          </div>
        </div>

        {/* Features Section */}
        <div className="mt-16 grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          <div className="bg-white rounded-lg shadow-lg p-6 text-center">
            <BookOpen className="w-12 h-12 text-church-blue mx-auto mb-4" />
            <h3 className="text-xl font-bold text-gray-800 mb-2">30 Lessons</h3>
            <p className="text-gray-600">Comprehensive Bible study series</p>
          </div>

          <div className="bg-white rounded-lg shadow-lg p-6 text-center">
            <Mail className="w-12 h-12 text-church-blue mx-auto mb-4" />
            <h3 className="text-xl font-bold text-gray-800 mb-2">3 at a Time</h3>
            <p className="text-gray-600">Receive lessons in manageable batches</p>
          </div>

          <div className="bg-white rounded-lg shadow-lg p-6 text-center">
            <Clock className="w-12 h-12 text-church-blue mx-auto mb-4" />
            <h3 className="text-xl font-bold text-gray-800 mb-2">Your Pace</h3>
            <p className="text-gray-600">Study at your own comfortable speed</p>
          </div>

          <div className="bg-white rounded-lg shadow-lg p-6 text-center">
            <Users className="w-12 h-12 text-church-blue mx-auto mb-4" />
            <h3 className="text-xl font-bold text-gray-800 mb-2">Personal</h3>
            <p className="text-gray-600">Individual attention and feedback</p>
          </div>
        </div>

        {/* Benefits Section */}
        <div className="mt-16 bg-gradient-to-r from-church-blue to-blue-800 text-white rounded-lg p-8">
          <h2 className="text-3xl font-bold text-center mb-8">
            What You'll Receive
          </h2>
          
          <div className="grid md:grid-cols-2 gap-8">
            <div>
              <h3 className="text-xl font-bold mb-4">Study Materials</h3>
              <ul className="space-y-2">
                <li className="flex items-start">
                  <span className="w-2 h-2 bg-white rounded-full mt-2 mr-3"></span>
                  <span>30 comprehensive Bible study lessons</span>
                </li>
                <li className="flex items-start">
                  <span className="w-2 h-2 bg-white rounded-full mt-2 mr-3"></span>
                  <span>Study questions for each lesson</span>
                </li>
                <li className="flex items-start">
                  <span className="w-2 h-2 bg-white rounded-full mt-2 mr-3"></span>
                  <span>Self-addressed stamped envelopes</span>
                </li>
              </ul>
            </div>
            
            <div>
              <h3 className="text-xl font-bold mb-4">Personal Support</h3>
              <ul className="space-y-2">
                <li className="flex items-start">
                  <span className="w-2 h-2 bg-white rounded-full mt-2 mr-3"></span>
                  <span>Graded lessons with feedback</span>
                </li>
                <li className="flex items-start">
                  <span className="w-2 h-2 bg-white rounded-full mt-2 mr-3"></span>
                  <span>No cost to you</span>
                </li>
                <li className="flex items-start">
                  <span className="w-2 h-2 bg-white rounded-full mt-2 mr-3"></span>
                  <span>No pressure or follow-up calls</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default SitbPage;
