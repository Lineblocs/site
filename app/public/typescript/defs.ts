declare class module {
    public static exports: any;
}
declare var console: any;
declare var require: any;
declare var setTimeout: any;
declare class LineUser {
    public info: any;
    public id: number;
    public workspace_name: string;
    public domain: string;
    constructor(info: any);
}
declare class LineCell {
    constructor(channel: LineChannel, cell: object, model: object, sourceLinks: Array < object > , targetLinks: Array < object > );
    public getMacroParam(name: string): any;
    public eventVars: Object;
    public processVars: Object;
    public channel: LineChannel;
    public cellChannel: LineChannel;
}
declare class LineWorkspace{
    public api_token: string;
    public api_secret: string;
    constructor();
}

declare class LineSDK {
    public createSession(token: string, secret: string): LineSession;
    public createBridge(autoHangup?: boolean): LineBridge;
    public createCall(flow: LineFlow, call: string, callerId: string, callType: string);
    public createConference(flow: LineFlow, name: string);
    public addChannel(channel: LineChannel);
    public removeFromBridge(channel: LineChannel);
    public listRecordings(tags: string, page: number): LineListResource < LineRecording > ;

    public playRecording(flow: LineFlow, channel: LineChannel, fileUrl: string);
    public getChannel(channelId: string);
}
declare class LineContext {
    public channel: LineChannel;
    public flow: LineFlow;
    public cell: LineCell;
    public workspace: LineWorkspace;
    public getSDK(): LineSDK;
}
declare class LineCall {
    public bridge: LineBridge;
    public lineChannel: LineChannel;
    public removeFromBridge();
    public getBridge(): LineBridge;
}
declare class LineConferenceMember {
    public call: LineCall;
}
declare class LineConference {
    public bridge: LineBridge;
    public waitingParticipants: Array<LineConferenceMember>;
    public participants: Array<LineConferenceMember>;
    public moderatorInConf: boolean;
    public on(name: string, callback: any);
}
declare class LineChannel {
    public channel: any;
    constructor(channel: object);

    public getBridge(): LineBridge;
    public removeFromBridge();
    public playTTS(flow: LineFlow, text: string, lang ? : string, gender ? : string, voice ? : string);
    public startAcceptingInput(keyTimeout: number);
    public resetDTMFListeners();
    public hangup();
    public on(name: string, callback: any);
    public automateCallHangup: boolean;
    public gotoFlowWidget(flow: LineFlow, name: string, voice ? : string);
    public startRinging();
    public stopRinging();

}
declare class LineBridge {
    public channels: Array < LineChannel > ;
    public channelsToAdd: Array < LineChannel > ;
    public addChannel(lineChannel: LineChannel);
    public addChannels(lineChannel1: LineChannel, lineChannel2: LineChannel);
    public playTTS(flow: LineFlow, text: string, lang ? : string, gender ? : string, voice ? : string);
    public destroy();
  public automateLegAHangup: boolean;

  public automateLegBHangup: boolean;
    public on(name: string, callback: any);

}
declare class LineSession {
    public info: any;
    public listRecordings(tags?: string, page?: string);
}


declare class LineRecording {
    public info: any;
    public deleteRecording();
    public addRecordingTag(name: string);
    public removeRecordingTag(name: string);
}

declare class LineListResource < T > {
    public meta: Object;
    public data: Array < T > ;
}
type LineEvent = Object;
declare class LineFlow {
    public callerId: string;
    public exten: string;
    public vars: any;
}
